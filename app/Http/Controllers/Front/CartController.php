<?php

namespace App\Http\Controllers\Front;

use App\Model\Common\Product;
use App\Model\Common\Review;
use App\Model\Common\Wishlist;
use App\SM\SM;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cart;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Controllers\Front\Session;
use App\Model\Common\AttributeProduct;

class CartController extends Controller
{

    public function cart()
    {
        $data["cart"] = Cart::instance('cart')->content();
        if (count($data["cart"]) > 0) {
            return view('frontend.checkout.cart', $data);
        } else {
            return redirect('/shop')->with('s_message', "Please Order First...!");
        }
    }

    public function add_to_cart(Request $request)
    {
        if ($request->ajax()) {
            $output = array();
            $id = $request->product_id;
            $cat = Cart::instance('cart')->content()->where('id', $id)->first();
            if (!empty($cat)) {
                $output['check_val'] = 0;
                $output['title'] = 'Product Already Added To Cart!';
            } else {
                if (!empty($request->qty)) {
                    $qty = $request->qty;
                } else {
                    $qty = 1;
                }

                $product_attribute_size = $request->product_attribute_size;
                $product_attribute_color = $request->product_attribute_color;
                $sizename = $request->sizename;
                $colorname = $request->colorname;

                if (!empty($id)) {
                    $product_info = Product::find($id);

                    if ($product_info->product_type == 2) {
                        $attribute_product = AttributeProduct::where('product_id', $id)->where('attribute_id', $product_attribute_size)->where('color_id', $product_attribute_color)->first();
                        if ($attribute_product->attribute_qty >= $qty) {
                            if (!empty($attribute_product->attribute_image)) {
                                $attribute_image = $attribute_product->attribute_image;
                            } else {
                                $attribute_image = $product_info->image;
                            }
                            Cart::instance('cart')->add(array(
                                array(
                                    'id' => $id,
                                    'name' => $product_info->title,
                                    'price' => $attribute_product->attribute_price,
                                    'qty' => $qty,
                                    'options' => array(
                                        'image' => $attribute_image,
                                        'slug' => $product_info->slug,
                                        'sku' => $product_info->sku,
                                        'size' => $product_attribute_size,
                                        'color' => $product_attribute_color,
                                        'sizename' => $sizename,
                                        'colorname' => $colorname,
                                    )
                                ),
                            ));
                            $output['header_cart_html'] = $this->header_cart_html();
                            $output['cart_icon'] = $this->cart_icon();
                            $output['cart_icon_pop'] = $this->cart_icon_cart_pop();
                            $output['popup_top_total'] = $this->popup_top_total();
                            $output['cart_count'] = Cart::instance('cart')->count();
                            $output['cart_item_count'] = Cart::instance('cart')->content()->count();
                            $output['sub_total'] = SM::currency_price_value(Cart::instance('cart')->subTotal());
                            $output['added_success'] = '<a href="' . url('product/' . $product_info->slug) . '" class="add-to-cart-ex" data-toggle="tooltip" data-placement="top" title="Added Product"><img src="' . asset('frontend/images/handbag.png') . '" class="img-height20"></a>';
                            $output['title'] = 'Product is added';
                            $output['check_val'] = 1;
                        } else {
                            $output['check_val'] = 0;
                            $output['title'] = 'Product Quantity Exceed Availability!';
                        }
                    } else {
                        if ($product_info->product_qty >= $qty) {
                            if ($product_info->sale_price > 0) {
                                $product_price = $product_info->sale_price;
                            } else {
                                $product_price = $product_info->regular_price;
                            }
                            Cart::instance('cart')->add(array(
                                array(
                                    'id' => $id,
                                    'name' => $product_info->title,
                                    'price' => $product_price,
                                    'qty' => $qty,
                                    'options' => array(
                                        'image' => $product_info->image,
                                        'slug' => $product_info->slug,
                                        'sku' => $product_info->sku,
                                    )
                                ),
                            ));

                            $output['header_cart_html'] = $this->header_cart_html();
                            $output['cart_icon'] = $this->cart_icon();
                            $output['cart_icon_pop'] = $this->cart_icon_cart_pop();
                            $output['popup_top_total'] = $this->popup_top_total();
                            $output['cart_count'] = Cart::instance('cart')->count();
                            $output['cart_item_count'] = Cart::instance('cart')->content()->count();
                            $output['sub_total'] = SM::currency_price_value(Cart::instance('cart')->subTotal());
                            $item = Cart::instance('cart')->content()->where('id', $id)->first();
                            $output['added_success'] = '<div class="input-group">
                                      <input type="button" data-row_id="' . $item->rowId . '" value="-" class="button-minus dec">
                                      <input type="text" id="' . $item->rowId . '" value="' . $item->qty . '" name="qty" class="quantity-field qty-inc-dc">
                                      <input type="button" data-row_id="' . $item->rowId . '" value="+" class="button-plus inc">
                                    </div>';
                            $output['title'] = 'Product is added';
                            $output['check_val'] = 1;
                        } else {
                            $output['check_val'] = 0;
                            $output['title'] = 'Product Quantity Exceed Availability!';
                        }
                    }
                } else {
                    $output['check_val'] = 0;
                    $output['title'] = 'Something wrong';
                }
            }


            echo json_encode($output);
        }
    }

    public function update_to_cart(Request $request)
    {
        if ($request->ajax()) {
            $rowId = $request->row_id;
            $qty = $request->qty;
            $cat = Cart::instance('cart')->content()->where('rowId', $rowId)->first();
            $product_info = Product::find($cat->id);
            if ($product_info->product_type == 2) {
                $attribute_product = AttributeProduct::where('product_id', $cat->id)->where('attribute_id', $cat->options->size)->where('color_id', $cat->options->color)->first();

                if ($attribute_product->attribute_qty >= $qty) {
                    Cart::instance('cart')->update($rowId, $qty);
                    $output['header_cart_html'] = $this->header_cart_html();
                    $output['cart_icon'] = $this->cart_icon();
                    $output['cart_table'] = $this->cart_table();
                    $output['cart_icon_pop'] = $this->cart_icon_cart_pop();
                    $output['popup_top_total'] = $this->popup_top_total();
                    $output['sub_total'] = SM::currency_price_value(Cart::instance('cart')->subTotal());
                    $output['cart_count'] = Cart::instance('cart')->count();
                    $item = Cart::instance('cart')->content()->where('rowId', $rowId)->first();
                    $output['added_success'] = '<div class="input-group">
                                      <input type="button" data-row_id="' . $item->rowId . '" value="-" class="button-minus dec">
                                      <input type="text" id="' . $item->rowId . '" value="' . $item->qty . '" name="qty" class="quantity-field qty-inc-dc">
                                      <input type="button" data-row_id="' . $item->rowId . '" value="+" class="button-plus inc">
                                    </div>';
                    $output['title'] = 'Product is Update';
                    $output['check_val'] = 1;
                } else {
                    $output['check_val'] = 0;
                    $output['title'] = 'Product Quantity Exceed Availability!';
                }
            } else {
                if ($product_info->product_qty >= $qty) {
                    Cart::instance('cart')->update($rowId, $qty);
                    $output['header_cart_html'] = $this->header_cart_html();
                    $output['cart_icon'] = $this->cart_icon();
                    $output['cart_table'] = $this->cart_table();
                    $output['cart_icon_pop'] = $this->cart_icon_cart_pop();
                    $output['popup_top_total'] = $this->popup_top_total();
                    $output['cart_count'] = Cart::instance('cart')->count();
                    $output['cart_item_count'] = Cart::instance('cart')->content()->count();
                    $output['sub_total'] = SM::currency_price_value(Cart::instance('cart')->subTotal());
                    $item = Cart::instance('cart')->content()->where('rowId', $rowId)->first();
                    $output['added_success'] = '<div class="input-group">
                                      <input type="button" data-row_id="' . $item->rowId . '" value="-" class="button-minus dec">
                                      <input type="text" id="' . $item->rowId . '" value="' . $item->qty . '" name="qty" class="quantity-field qty-inc-dc">
                                      <input type="button" data-row_id="' . $item->rowId . '" value="+" class="button-plus inc">
                                    </div>';

                    $output['title'] = 'Product is Update';
                    $output['check_val'] = 1;
                } else {
                    $output['check_val'] = 0;
                    $output['title'] = 'Product Quantity Exceed Availability!';
                }
            }
            echo json_encode($output);
        }
    }

    public
    function remove_to_cart(Request $request)
    {
        if ($request->ajax()) {
            $output = array();
            $id = $request->product_id;
            $cat = Cart::instance('cart')->content()->where('rowId', $id)->first();
            if (!empty($cat)) {
                Cart::instance('cart')->remove($id);
                $output['cart_count'] = Cart::instance('cart')->count();
                $output['cart_item_count'] = Cart::instance('cart')->content()->count();
                $output['header_cart_html'] = $this->header_cart_html();
                $output['cart_icon'] = $this->cart_icon();
                $output['cart_table'] = $this->cart_table();
                $output['popup_top_total'] = $this->popup_top_total();
                $output['sub_total'] = SM::currency_price_value(Cart::instance('cart')->subTotal());
                $output['title'] = 'This Product remove';
                echo json_encode($output);
            }
        }
    }

    public
    function header_cart_html()
    {
        $html = '';
        $items = Cart::instance('cart')->content();
        if (count($items) > 0) {
            foreach ($items as $id => $item) {
                $html .= '<div class="add-pro-liner">
                        <div class="counting">
                             <i class="fa fa-plus inc" data-row_id="' . $item->rowId . '" style="color: green;"></i>
                            <input type="hidden" name="qty" class="form-control input-sm qty-inc-dc" id="' . $item->rowId . '" value="' . $item->qty . '">
                            <h3 class="itemqty"><span>' . $item->qty . '</span></h3>
                            <i class="fa fa-minus dec" data-row_id="' . $item->rowId . '"  style="color: green;"></i>
                        </div>
                        <img src="' . SM::sm_get_the_src($item->options->image, 100, 122) . '" alt="' . $item->name . '">
                        <div class="pro-head">
                            <h3>' . $item->name . '</h3>
                        </div>
                        <h3 class="ammount">' . SM::currency_price_value($item->price) . '</h3>
                        <span class="pro-close removeToCart" data-product_id="' . $id . '" ><i class="fa fa-times-circle"></i></span>
                    </div>
                    <hr>';
            }
        } else {
            $html .= '<div class="empty_img image-emty">
                    <img class="image-emty-busket" src="' . asset('/frontend/images/busketempty.png') . '">
                </div>
                <div class="text-center">
                    <span>Empty Cart</span>
                </div>';
        }

        $html .= '</div>';

        return $html;
    }

    public
    function cart_icon()
    {
        $html = ' <span class="badge badge-secondary cart-header "> ' . Cart::instance('cart')->count() . '</span>
                                <img src=' . asset("frontend/images/cart.png") . '>';
        return $html;
    }

    public
    function cart_icon_cart_pop()
    {
        $html = '<img src="' . url('/frontend/images/cart_white.png') . '">
                    <p>' . Cart::instance('cart')->count() . ' Item(s)</p>
        <p> <span>' . SM::currency_price_value(Cart::instance('cart')->subTotal()) . '</span></p>';
        return $html;
    }

    public
    function popup_top_total()
    {
        $html = '<i class="fa fa-shopping-bag"></i>' . Cart::instance('cart')->count() . ' Items in my cart';
        return $html;
    }

    public
    function cart_table()
    {
        $html = '';
        $cart = Cart::instance('cart')->content();
        foreach ($cart as $id => $item) {
            $html .= '<tr id="cartClose" id="tr_' . $item->rowId . '" class="removeCartTrLi">
                                        <td>
                                            <a href="' . url('product/' . $item->options->slug) . '">
                                                <img src="' . SM::sm_get_the_src($item->options->image, 60, 80) . '"
                                                     style="height: 60px;">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="' . url('product/' . $item->options->slug) . '">
                                                <p class="product-title">' . $item->name . '</p>
                                            </a>
                                         </td>
                                        <td>
                                            <div class="select-product-count mar-top-0">
                                                <form>
                                                    <div class="input-group">
                                                        <span data-row_id="' . $item->rowId . '" class="input-group-addon dec" id="decrease"
                                                             value="Decrease Value"><i
                                                                    class="fa fa-minus-circle"
                                                                    aria-hidden="true"></i></span>

                                                        <input type="number" name="qty" class="form-control input-sm qty-inc-dc"
                                                               id="' . $item->rowId . '" value="' . $item->qty . '">


                                                        <span data-row_id="' . $item->rowId . '" class="input-group-addon inc" id="increase"
                                                            value="Increase Value"><i
                                                                    class="fa fa-plus-circle"
                                                                    aria-hidden="true"></i></span>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            <b>' . SM::currency_price_value($item->price) . '</b>
                                        </td>
                                        <td>
                                            <b>' . SM::currency_price_value($item->price * $item->qty) . '</b>
                                        </td>
                                        <td>

                                            <button data-product_id="' . $item->rowId . '" id="close-cart" class="removeToCart close-cart cart-close-btn">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>';
        }

        return $html;
    }

//    ----------Compare------------
    public
    function compare()
    {
        $data['activeMenu'] = 'compare';
        $data["compares"] = Cart::instance('compare')->content();

        return view("frontend.products.compare", $data);
    }

    public function add_to_compare(Request $request)
    {
        if ($request->ajax()) {
            $output = array();
            $id = $request->product_id;
            $exists_compare = Cart::instance('compare')->content()->where('id', $id)->first();
            if (!empty($exists_compare)) {
                $output['exists_compare'] = 1;
                $output['title'] = 'This Product Already compare';
                echo json_encode($output);
            } else {
                $product_info = Product::find($id);
                $brand_name = $product_info->brand->title;
                Cart::instance('compare')->add(array(
                    array(
                        'id' => $id,
                        'name' => $product_info->title,
                        'price' => $product_info->regular_price,
                        'qty' => 1
                    ),
                ));
                $output['header_cart_html'] = $this->header_cart_html();
                $output['compare_count'] = Cart::instance('compare')->count();
                $output['title'] = 'Product added to compare';
                echo json_encode($output);
                //        }
            }
        }
    }

    public function remove_to_compare(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->product_id;
            $cat = Cart::instance('compare')->content()->where('rowId', $id)->first();
            if (!empty($cat)) {
                Cart::instance('compare')->remove($id);
                $output['header_cart_html'] = $this->header_remove_html();
                $output['compare_count'] = Cart::instance('compare')->count();
                $output['title'] = 'Compare remove';
                echo json_encode($output);
            }
        }
//        Cart::instance('compare')->remove($rowId);
//        return redirect()->back()->with('s_message', 'Product removed Compare!');
    }

    public
    function header_remove_html()
    {

    }

//-----------wishlist---------

    public
    function add_to_wishlist(Request $request)
    {
        if ($request->ajax()) {
            $check_wishlist = Wishlist::where('product_id', $request->product_id)->where('user_id', Auth::id())->first();
            if (!empty($check_wishlist)) {
                $output['check_wishlist'] = 1;
                $output['title'] = 'This Product Already wishlist';
                echo json_encode($output);
            } else {
                $wishlistModel = new Wishlist;
                $wishlistModel->product_id = $request->product_id;
                $wishlistModel->user_id = Auth::id();
                $wishlistModel->save();
//            $output['compare_count'] = Auth::user()->wishlists->count();
                $output['title'] = 'Product added to wishlist';
                $output['header_cart_html'] = $this->header_cart_html();
                $output['header_wish_toggol'] = $this->header_wishlist_toggol();
                echo json_encode($output);
            }
        }
    }

    public
    function remove_to_wishlist(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->wshlist_id;
            $wishlist = Wishlist::find($id);
            if (!empty($wishlist)) {
                Wishlist::destroy($id);
                $output['title'] = 'Wishlist remove';
                $output['header_wish_html'] = $this->header_wishlist_html();
                $output['header_wish_toggol'] = $this->header_wishlist_toggol();
                echo json_encode($output);

            }
        }
    }

    public
    function header_wishlist_toggol()
    {
        $html = count(Auth::user()->wishlists);
        return $html;
    }

    public
    function header_wishlist_html()
    {
        $wishlist_data = Wishlist::where('user_id', Auth::id())->orderby('id', 'DESC')->get();
        $html = '<ul class="row list-wishlist">';
        foreach ($wishlist_data as $wishlist) {
            if (count($wishlist) > 0) {
                $html .= '<li class="col-sm-3 wishlistRow">
                    <div class="product-img">
                        <a href=' . url('product' . $wishlist->product->slug) . '>
                            <img src="' . SM::sm_get_the_src($wishlist->product->image, 210, 255) . '" alt="' . $wishlist->product->title . '" class="image-style">
                        </a>
                    </div>
                    <h5 class="product-name">
                        <a href=' . url('product/' . $wishlist->product->slug) . '>' . $wishlist->product->title . '</a>
                        <a data-wshlist_id=' . $wishlist->id . ' class="removeToWishlist pull-right" title="Remove item" href="javascript:void(0)"><i class="fa fa-close"></i></a>
                    </h5>
                </li>';
            } else {
                $html .= '<div class="alert alert-warning">
                        <i class="fa fa-warning"></i> No Wishlist Found!
                    </div>';
            }
        }
        $html .= '</ul>';


        return $html;
    }


    //-----------review-------------------------

    public function add_to_review(Request $request)
    {
//
        if (Auth::check()) {
            $this->validate($request, [
                'description' => 'required',
                'rating' => 'required'
            ]);

            if ($request->ajax()) {
                $output = array();
                auth()->user()->reviews()->create($request->all());
//                $review = new Review;
//                $review->product_id = $request->product_id;
//                $review->rating = $request->rating;
//                $review->description = $request->description;
//                $review->user_id = Auth::id();
//                $review->save();
                $output['title'] = 'You review submitted admin approved then show!';
                $output['check_reviewAuth'] = 0;
                echo json_encode($output);
            }
        } else {
            $output['title'] = 'Please Login First...!';
            $output['check_reviewAuth'] = 1;
            echo json_encode($output);
        }
    }

    function remove_to_review(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->review_id;
            $wishlist = Review::find($id);
            if (!empty($wishlist)) {
                Review::destroy($id);
                $output['title'] = 'Product Review remove';
                echo json_encode($output);
            }
        }
        return back()->with('s_message', "Wishlist Remove Successfully!");
    }

}
