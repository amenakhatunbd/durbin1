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
            return view('frontend.products.cart', $data);
        } else {
            return redirect('/shop')->with('s_message', "Please Order First...!");
        }
    }

   public function add_to_cart(Request $request)
    {
        if ($request->ajax()) {
            $output = array();
            $id = $request->product_id;
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
                        $output['sub_total'] = SM::currency_price_value(Cart::instance('cart')->subTotal());
                        $output['title'] = 'Product is added';
                        $output['message'] = 'thank you for your order';
                        $output['check_val'] = 1;
                    } else {
                        $output['check_val'] = 0;
                        $output['error_title'] = 'Out of stock this product';
                        $output['error_message'] = 'Current stock this product ' . $attribute_product->attribute_qty;
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
                        $output['sub_total'] = SM::currency_price_value(Cart::instance('cart')->subTotal());
                        $output['title'] = 'Product is added';
                        $output['message'] = 'thank you for your order';
                        $output['check_val'] = 1;
                    } else {
                        $output['check_val'] = 0;
                        $output['error_title'] = 'Out of stock this product';
                        $output['error_message'] = 'Current stock this product ' . $product_info->product_qty;
                    }
                }
            } else {
                $output['check_val'] = 0;
                $output['error_title'] = 'Something wrong';
                $output['error_message'] = 'Something wrong';
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
                    $output['title'] = 'Product is Update';
                    $output['message'] = 'thank you';
                    $output['check_val'] = 1;
                } else {
                    $output['check_val'] = 0;
                    $output['title'] = 'Out of stock this product';
                    $output['message'] = 'Current stock this product ' . $product_info->product_qty;
                }
            } else {
                if ($product_info->product_qty >= $qty) {
                    Cart::instance('cart')->update($rowId, $qty);
                    $output['header_cart_html'] = $this->header_cart_html();
                    $output['cart_icon'] = $this->cart_icon();
                    $output['cart_table'] = $this->cart_table();
                    $output['cart_icon_pop'] = $this->cart_icon_cart_pop();
                    $output['popup_top_total'] = $this->popup_top_total();
                    $output['sub_total'] = SM::currency_price_value(Cart::instance('cart')->subTotal());
                    $output['title'] = 'Product is Update';
                    $output['message'] = 'thank you';
                    $output['check_val'] = 1;
                } else {
                    $output['check_val'] = 0;
                    $output['title'] = 'Out of stock this product';
                    $output['message'] = 'Current stock this product ' . $product_info->product_qty;
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
                $output['header_cart_html'] = $this->header_cart_html();
                $output['cart_icon'] = $this->cart_icon();
                $output['cart_table'] = $this->cart_table();
                $output['popup_top_total'] = $this->popup_top_total();
                $output['sub_total'] = SM::currency_price_value(Cart::instance('cart')->subTotal());
                $output['title'] = 'This Product remove';
                $output['message'] = 'thank you';
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
                        <span class="pro-close removeToCart" data-product_id="' . $id . '"  onclick="delete_cart_product(1196)"><i class="fa fa-times-circle"></i></span>
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
        $html .= '
                    <thead>
                        <tr>
                            <th class="cart_product">Product</th>
                            <th>Description</th>
                            <th>Unit price</th>
                          
                            <th>Qty</th>
                            <th>Total</th>
                            <th class="action"><i class="fa fa-trash-o"></i></th>
                        </tr>
                    </thead>
                    <tbody>';
        $cart = Cart::instance('cart')->content();
        foreach ($cart as $id => $item) {
            $html .= '<tr id="tr_' . $item->rowId . '" class="removeCartTrLi">
                            <td class="cart_product">
                                <a href="' . url('product/' . $item->options->slug) . '">
                                    <img src="' . SM::sm_get_the_src($item->options->image, 100, 122) . '"
                                         alt="' . $item->name . '"></a>
                            </td>
                            <td class="cart_description">
                                <p class="product-name">
                                    <a style="color: #5cad5c;" href="' . url('product/' . $item->options->slug) . '"><strong>' . $item->name . ' </strong></a>
                                    </p>
                                    <span class="cart_ref">SKU : ' . $item->options->sku . '</span><br>';
            if ($item->options->colorname != '') {
                $html .= '<span><a href="#">Color : ' . $item->options->colorname . '</a></span><br>';
            }
            if ($item->options->sizename != '') {
                $html .= '<span><a href="#">Size : ' . $item->options->sizename . '</a></span><br>';
            }
            $html .= '</td>
                            
                             <td class="price"><span>' . SM::currency_price_value($item->price) . '</span></td>
                            <td class="qty">
                                <style>
                                    .input-group-btn {
                                        font-size: unset;
                                    }
                                </style>
                                <div class="input-group" style="display: table-caption;">
                                   <span class="input-group-btn inc" data-row_id="' . $item->rowId . '" id=""><i  class="fa fa-plus" aria-hidden="true"></i></span> 
                                        <input id="' . $item->rowId . '" class="form-control" name="qty" type="text" value="' . $item->qty . '">
                                      <span id="" class="input-group-btn dec"  data-row_id="' . $item->rowId . '"><i  class="fa fa-minus" aria-hidden="true"></i></span>

                                </div>
                            </td>
                            <td class="price">
                                <span>' . SM::currency_price_value($item->price * $item->qty) . '</span>
                            </td>
                            <td class="action">
                                <a data-product_id="' . $item->rowId . '" class="btn btn-danger remove_link removeToCart" title="Delete item"
                                   href="javascript:void(0)"><i class="fa fa-trash-o"></i></a>
                             
                            </td>
                        </tr>';
        }
        $html .= '</tbody>
                    <tfoot class="tfoot_class">
                    <div>
                        <tr>
                            <td colspan="2" rowspan="3"></td>
                            <td colspan="3">Sub Total</td>
                            <td colspan="2">' . SM::currency_price_value(Cart::instance('cart')->subTotal()) . '</td>
                        </tr> 
                        <tr>
                            <td colspan="3"><strong>Total</strong></td>
                            <td colspan="2"><strong>' . SM::currency_price_value(Cart::instance('cart')->total()) . '</strong></td>
                        </tr>
                      
                    </div>
                    </tfoot>
               ';
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
                $output['error_title'] = 'This Product Already compare';
                $output['error_message'] = 'This Product Already compare';
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
                $output['message'] = 'thank you for compare';
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
                $output['message'] = 'thank you';
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
                $output['error_title'] = 'This Product Already wishlist';
                $output['error_message'] = 'This Product Already wishlist';
                echo json_encode($output);
            } else {
                $wishlistModel = new Wishlist;
                $wishlistModel->product_id = $request->product_id;
                $wishlistModel->user_id = Auth::id();
                $wishlistModel->save();
//            $output['compare_count'] = Auth::user()->wishlists->count();
                $output['title'] = 'Product added to wishlist';
                $output['message'] = 'thank you for wishlists';
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
                $output['message'] = 'thank you';
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
                $output['message'] = 'Description';
                $output['check_reviewAuth'] = 0;
                echo json_encode($output);
            }
        } else {
            $output['error_title'] = 'Please Login First...!';
            $output['error_message'] = '';
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
                $output['message'] = 'thank you';
                echo json_encode($output);
            }
        }
        return back()->with('s_message', "Wishlist Remove Successfully!");
    }

}
