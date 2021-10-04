<?php

namespace App\Http\Controllers\Front;

use App\Model\Common\Attribute;
use App\Model\Common\AttributeProduct;
use App\Model\Common\Author;
use App\Model\Common\Brand;
use App\Model\Common\Country;
use App\Model\Common\Publisher;
use App\Model\Common\Product as Product;
use App\Model\Common\Category;
use App\Model\Common\Unit;
use Illuminate\Support\Str;
use App\Model\Common\Tag;
use App\Model\Common\Media;
use App\Model\Common\Media_permissions;
use App\Model\Common\Order;
use App\Model\Common\Payment;
use App\Model\Common\Review;
use App\Model\Common\Wishlist;
use App\Rules\SmPasswordMatch;
use App\User;
use App\Model\Common\Order_detail;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SM\SM;
use Validator;
use Illuminate\Support\Facades\Auth;
use Response;
use Cart;
use DB;
use Hash;

class Dashboard extends Controller
{

    /**
     * Show customer dasshboard
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data['activeMenu'] = 'dashboard';
        $data["userInfo"] = $user_info = \Auth::user();
        if($user_info->type == 'publisher'):
        $data['publiser_orderInfo']=$totalSaleQty=$this->totalSalesOrder();
        $totalSales=0;
        $completeOrder = 0;
        $processingOrder=0;
        $pendingOrder=0;

     
        if(!empty($totalSaleQty)):
            foreach($totalSaleQty as $key => $value):
                $totalSales+=$value->totalQty;
                if($value->order_status == 1):
                    $completeOrder+=$value->totalQty;
                endif;
                if($value->order_status == 2):
                    $processingOrder+=$value->totalQty;
                endif;
                if($value->order_status == 3):
                    $pendingOrder+=$value->totalQty;
                endif;
            endforeach;
        endif;
        $data['totalSalesQty'] = $totalSales;
        $data['completeOrderQty'] = $completeOrder;
        $data['processingOrder'] = $processingOrder;
        $data['pendingOrderQty'] = $pendingOrder;
        $data['completeOrderDetails'] = $this->salesQtyDetailsByStatus(1);
        $data['processingOrderDetails'] = $this->salesQtyDetailsByStatus(2);
        $data['pendingOrderDetails'] = $this->salesQtyDetailsByStatus(3);
        $data['totalSalesQtyDetails'] = $this->salesQtyDetailsByStatus();
    endif;
       
        return view("customer/dashboard", $data);
    }


public function salesQtyDetailsByStatus($status =null){
        $user_info   = Auth::user();
        if($user_info->type == 'publisher'):
               $publisherInfo = Publisher::where('slug',$user_info->username)->first();
               $productList   =   Product::select('id')->where('publisher_id',$publisherInfo->id)->get();
            if(!empty($productList)):
                  $product=array();
               foreach($productList as $key => $value):
                  $product[]=$value->id;
               endforeach;
           endif;
            if(!empty($product)):
                if($status == null):
$orderInfo = Order_detail::select('order_details.product_id','order_details.product_qty','products.title')
            ->join('orders', 'orders.id', '=' , 'order_details.order_id')
            ->join('products', 'products.id', '=' , 'order_details.product_id')
            
            ->whereIn('product_id',$product)
            ->get();
                else:
$orderInfo = Order_detail::select('order_details.product_id','order_details.product_qty','products.title')
            ->join('orders', 'orders.id', '=' , 'order_details.order_id')
            ->join('products', 'products.id', '=' , 'order_details.product_id')
            ->where('orders.order_status',$status)
            ->whereIn('product_id',$product)
            ->get();
                endif;
                return $orderInfo;
            endif;

          
        endif;  
    }



public function totalSalesOrder(){
        $user_info   = Auth::user();
        if($user_info->type == 'publisher'):
               $publisherInfo = Publisher::where('slug',$user_info->username)->first();
               $productList   =   Product::select('id')->where('publisher_id',$publisherInfo->id)->get();
             
            if(!empty($productList)):
                  $product=array();
               foreach($productList as $key => $value):
                  $product[]=$value->id;
               endforeach;
              
           endif;
            if(!empty($product)):
            $orderInfo = Order_detail::selectRaw('orders.order_status,sum(order_details.product_qty) as totalQty')->join('orders', 'orders.id', '=' , 'order_details.order_id')->whereIn('product_id',$product)->groupBy('orders.order_status')->get();
            return $orderInfo;
            endif;
           
        endif;  

    }



    


public function publisherOrderId(){
        $user_info   = Auth::user();
        if($user_info->type == 'publisher'):
                $publisherInfo = Publisher::where('slug',$user_info->username)->first();
               $productList = Product::select('id')->where('publisher_id',$publisherInfo->id)->get();
             
            if(!empty($productList)):
                  $product=array();
               foreach($productList as $key => $value):
                  $product[]=$value->id;
               endforeach;
              
           endif;
            if(!empty($product)):
            $orderInfo = Order_detail::select('orders.order_status','order_details.order_id')->join('orders', 'orders.id', '=' , 'order_details.order_id')->whereIn('product_id',$product)->groupBy('order_details.order_id')->get();

            endif;
            if(!empty($orderInfo)):
                        $orderId=array();
                    foreach($orderInfo as $key => $value):
                       $orderId[]=$value->order_id;
                    endforeach;
            endif;
           return $orderId;
        endif;  

    }



    public function add_book()
    {

        $data['activeMenu'] = 'dashboard';
        $data["userInfo"] = \Auth::user();
        $user_info_type  = Auth::user()->type;


        $data["categories"] = Category::where("parent_id", 0)->get();
        $data["size_lists"] = Attribute::Size()->orderBy('title')->get();
        $data["color_lists"] = Attribute::Color()->orderBy('title')->get();
        $data["all_brands"] = Brand::orderBy('title')->get();
        $data["all_units"] = Unit::orderBy('title')->get();
        $data["author_lists"] = Author::orderBy('title')->get();

        if ($user_info_type == 'Publisher') {
            $data["publisher_lists"] = Publisher::where('slug', Auth::user()->slug)->get();
        } else {
            $data["publisher_lists"] = Publisher::orderBy('title')->get();
        }
        $data["country_lists"] = Country::orderBy('name')->get();
        return view("customer/products/add", $data);
    }



    public function edit_product($slug)
    {

        $data["product_info"] = $productinfo = Product::with("categories", "tags")->where('slug', $slug)->first();
        if (!empty($data["product_info"])) {
            $data['activeMenu'] = 'dashboard';
            $data["userInfo"] = \Auth::user();
            $data['product_info']->read_a_little = json_decode($data['product_info']->read_a_little);
            //$data['product_info']->categories = SM::get_ids_from_data($data['product_info']->categories);
            $data['product_info']->tags = SM::sm_get_product_tags($data['product_info']->tags);
            $data['all_categories'] = Category::where('parent_id', 0)->get();
            $data["size_lists"] = Attribute::Size()->orderBy('title')->pluck('title', 'id');
            $data["color_lists"] = Attribute::Color()->orderBy('title')->pluck('title', 'id');
            $data["all_brands"] = Brand::orderBy('title')->pluck('title', 'id');
            $data["all_units"] = Unit::orderBy('title')->pluck('title', 'id');
            $data["author_lists"] = Author::orderBy('title')->pluck('title', 'id');
            $data["selected_authors"] = explode(",", $data["product_info"]->author_id);
            $data["selected_translator"] = explode(",", $data["product_info"]->translator_id);
            $data["publisher_lists"] = Publisher::orderBy('title')->pluck('title', 'id');
            $data["country_lists"] = Country::orderBy('name')->get();
            $data["categories"] = Category::where("parent_id", 0)->get();
            $allcate = array();
            foreach ($productinfo->categories as $key => $category) {
                $allcate[] = $category->id;
            }
            $data["selected_category"] = $allcate;
            return view("customer/products/edit", $data);
        } else {
            return redirect()->back();
        }
    }



    public function update_product(Request $request, $slug)
    {

        $productInfo = Product::where('slug', $slug)->first();
        if (!$productInfo) {
            return redirect()->route('dashboard')->with('w_message', "Sorry product id does not match!");
        }



        $this->validate($request, [
            'title' => 'required|max:300|min:2',
            'product_english_title' => 'required|max:300|min:2',
            //            'image' => "required",
            // 'sku' => 'required  | unique:products',
            'categories' => 'required | array',
            'regular_price' => 'required|min:2|max:10',
            'author_id' => 'required',
            // 'seo_title' => 'max:70',
            // 'meta_description' => 'max:215'
        ]);

        if (!empty($request->input("sale_price"))) {
            $sale_price = $request->input("sale_price");
        } else {
            $sale_price = 0;
        }
        $product = Product::findOrFail($productInfo->id);
        $product->title = $request->input("title");
        $product->product_english_title = $request->input("product_english_title");
        $product->long_description = $request->input("long_description", "");
        // $product->long_description = $request->input("long_description", "");
        $product->is_featured = 0;
        $product->sku = $productInfo->sku;
        $product->stock_status = $request->input("stock_status", "");
        $product->tax_class = $request->input("tax_class", "");
        $product->regular_price  = $printPrice = $request->input("regular_price", "");
        $product->vendor_discount  = $discount = $request->input("vendor_discount", "");

        if (!empty($discount) && $discount > 0) {
            $merchentPrice =  $printPrice - ($printPrice / 100 * $discount);
            $product->sale_price =  $merchentPrice + ($printPrice / 100 * 15);
        } else {
            $product->sale_price =  $printPrice + ($printPrice / 100 * 15);
        }

        $product->brand_id = $request->input("brand_id", "");
        $product->product_qty = 20; // $request->input("product_qty", "");
        $product->alert_quantity = 10; //$request->input("alert_quantity", "");
        $product->unit_id = 1; //$request->input("unit_id", "");
        $product->product_type = 1; // $request->input("product_type", "");
        $product->editor = $request->input("editor", "");
        $product->status = 2; //$request->input("status", "");
        $author = $request->author_id;

        $allAuthor = array();
        foreach ($author as $key => $value) :
            if (!is_numeric($value)) {
                $allAuthor[] = $this->saveNewAuthorOrTransalator($value);
            } else {
                $allAuthor[] = (int)$value;
            }
        endforeach;

        $product->author_id =  collect($allAuthor)->implode(',');
        //translator
        $translator = $request->translator_id;
        if (!empty($translator)) :
            $allTranslator = array();
            foreach ($translator as $key => $value) :
                if (!is_numeric($value)) {
                    $allTranslator[] = $this->saveNewAuthorOrTransalator($value);
                } else {
                    $allTranslator[] = $value;
                }
            endforeach;
            $product->translator_id =  collect($allTranslator)->implode(',');
        endif;

        $slug = Auth::user()->username;
        $publisher_info = \App\Model\Common\Publisher::where('slug', $slug)->first();
        $product->publisher_id = $publisher_info->id;
        $product->isbn = $request->input("isbn", "");
        $product->edition_date = $request->input("edition_date", "");
        $product->number_of_pages = $request->input("number_of_pages", "");
        $product->country_id = $request->input("country_id", "");
        $product->language = 'বাংলা'; //
        $product->seo_title = $request->input("title", "");
        $product->meta_key = $request->input("title", "");
        $product->meta_description = $request->input("title", "");


        if (!empty($request->image)) {
            $maxPost = 10 * 1024;
            $img = SM::sm_image_upload('image', "required|max:$maxPost|mimes:png,gif,jpeg,jpg", 0, 1);
            if (is_array($img) && isset($img['insert_id'])) {
                $product->image = $img['slug'];
            }
        } else {
            $product->image = $request->old_image;
        }

        if (isset($request->image_gallery) && $request->image_gallery != '') {
            $product->image_gallery = $request->image_gallery;
        }
        $product->read_a_little = json_encode($request['read_a_little']);

        $product->slug = $productInfo->slug;
        $product->created_by = SM::current_user_id();

        if ($product->save()) {


            $productId = $product->id;
            if (!empty($request->attribute_id[0])) {
                $data = [];
                foreach ($request->attribute_id as $key => $v) {
                    $data = array(
                        'attribute_id' => $v,
                        'product_id' => $productId,
                        'color_id' => $request->color_id[$key],
                        'attribute_legnth' => $request->attribute_legnth[$key],
                        'attribute_front' => $request->attribute_front[$key],
                        'attribute_back' => $request->attribute_back[$key],
                        'attribute_chest' => $request->attribute_chest[$key],
                        'attribute_qty' => $request->attribute_qty[$key],
                        'attribute_price' => $request->attribute_price[$key],
                        'attribute_image' => $request->attribute_image[$key],
                    );
                    AttributeProduct::insert($data);
                }
            }

            $allCategory = array();
            foreach ($request->categories as $cat) {
                if (!is_numeric($cat)) {
                    $allCategory[] =  $cat =  $this->saveNewCategory($cat);
                } else {
                    $allCategory[] = $cat;
                    $cat = $cat;
                }
                $categories[$cat]['created_at'] = date("Y-m-d H:i:s");
                $categories[$cat]['updated_at'] = date("Y-m-d H:i:s");
                $catInfo = Category::find($cat);
                if (!empty($catInfo)) {
                    $catInfo->increment("total_products");
                }
            }
            $product->categories()->sync($categories);

            //insert tag as a author

            $seoAuthor = array();
            foreach ($allAuthor as $author) {
                $authorInfo =  Author::findOrFail($author); //collect author info
                if (!empty($authorInfo)) {
                    $seoAuthor[] = $authorInfo->title;
                    $tag = $this->saveTag($authorInfo->title); //insert in tag table
                    $insTags[$tag]['created_at'] = date("Y-m-d H:i:s");
                    $insTags[$tag]['updated_at'] = date("Y-m-d H:i:s");
                    $tagInfo = Tag::find($tag);
                    if (!empty($tagInfo)) {
                        $tagInfo->increment("total_products");
                    }
                }
            }
            $product->tags()->sync($insTags);
            //insert tag as a translator
            $seoTranslator = array();
            if (!empty($allTranslator)) :
                foreach ($allTranslator as $author) {
                    $translatorInfo =  Author::find($author);
                    // $tagname=$translatorInfo->title;
                    if (!empty($translatorInfo)) {
                        $seoTranslator[] = $translatorInfo->title;
                        $tag = $this->saveTag($translatorInfo->title);
                        $insTags[$tag]['created_at'] = date("Y-m-d H:i:s");
                        $insTags[$tag]['updated_at'] = date("Y-m-d H:i:s");
                        $tagInfo = Tag::find($tag);
                        if (!empty($tagInfo)) {
                            $tagInfo->increment("total_products");
                        }
                    }
                }
                $product->tags()->sync($insTags);
            endif;
            //insert tag category

            $seoCategory = array();
            foreach ($allCategory as $cateogry) {
                $categoryInfo =  Category::find($cateogry);
                if (!empty($categoryInfo)) {
                    $seoCategory[] = $categoryInfo->title;
                    $tag = $this->saveTag($categoryInfo->title);
                    $insTags[$tag]['created_at'] = date("Y-m-d H:i:s");
                    $insTags[$tag]['updated_at'] = date("Y-m-d H:i:s");
                    $tagInfo = Tag::find($tag);
                    if (!empty($tagInfo)) {
                        $tagInfo->increment("total_products");
                    }
                }
            }
            $product->tags()->sync($insTags);
            //insert tag as a category name,others
            $seoothertag = array();
            $othersTag = array($product->title, $product->long_description,$product->slug,$product->product_english_title);
            foreach ($othersTag as $others) {
                if (!empty($others)) {
                    $seoothertag[] = $others;
                    $tag = $this->saveTag($others);
                    $insTags[$tag]['created_at'] = date("Y-m-d H:i:s");
                    $insTags[$tag]['updated_at'] = date("Y-m-d H:i:s");
                    $tagInfo = Tag::find($tag);
                    if (!empty($tagInfo)) {
                        $tagInfo->increment("total_products");
                    }
                }
            }
            $product->tags()->sync($insTags);
            $metaKey = '';
            if (!empty($seoCategory)) {
                $metaKey .= implode(",", $seoCategory) . ',';
            }
            if (!empty($seoAuthor)) {
                $metaKey .= implode(",", $seoAuthor) . ',';
            }
            if (!empty($seoTranslator)) {
                $metaKey .= implode(",", $seoTranslator) . ',';
            }
            if (!empty($othersTag)) {
                $metaKey .= implode(",", $othersTag) . ',';
            }
            $product->meta_key = $metaKey;
            $product->save();

            $this->removeThisCache();
            // return redirect(SM::smAdminSlug("products/$id/edit"))->with("s_message", "Product Updated Successfully!");
            return redirect()->route('books')->with("s_message", "Product Updated Successfully!");
        } else {

            //  return redirect()->route('books');
        }
    }


    public function store_product(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|max:300|min:2',
            'product_english_title' => 'required|max:300|min:2',
            //'image' => "required",
            //'sku' => 'required  | unique:products',
            'categories' => 'required | array',
            'regular_price' => 'required|min:2|max:10',
            'author_id' => 'required',
            //'g-recaptcha-response' => 'required|captcha',

            // 'seo_title' => 'max:70',
            // 'meta_description' => 'max:215'
        ]);

       
        if (!empty($request->input("sale_price"))) {
            $sale_price = $request->input("sale_price");
        } else {
            $sale_price = 0;
        }
        $product = new Product();
        $product->title = $request->input("title");
        $product->product_english_title = $request->input("product_english_title");
        $product->long_description = $request->input("long_description", "");
        $product->is_featured = 0;
        $lastProductInfo = Product::orderBy('id', 'DESC')->first();
        $product->sku = "durbiin-" . str_pad($lastProductInfo->id + 1, 5, "0", STR_PAD_LEFT);
        $product->stock_status = $request->input("stock_status", "");
        $product->tax_class = $request->input("tax_class", "");
        $product->regular_price = $printPrice = $request->input("regular_price", "");
        $product->vendor_discount  = $discount = $request->input("vendor_discount", "");
        if (!empty($discount) && $discount > 0) {
            $merchentPrice =  $printPrice - ($printPrice / 100 * $discount);
            $product->sale_price =  $merchentPrice + ($printPrice / 100 * 15);
        } else {
            $product->sale_price =  $printPrice + ($printPrice / 100 * 15);
        }
        $product->brand_id = $request->input("brand_id", "");
        $product->product_qty = 20;
        $product->alert_quantity = 10;
        $product->unit_id = 1;
        $product->editor = $request->input("editor", "");
        $request->input("unit_id", "");

        $product->product_type = 1;
        $product->status = 2;
        //author 
        $author = $request->author_id;
        $allAuthor = array();
        foreach ($author as $key => $value) :
            if (!is_numeric($value)) {
                $allAuthor[] = $this->saveNewAuthorOrTransalator($value);
            } else {
                $allAuthor[] = (int)$value;
            }
        endforeach;

        $product->author_id =  collect($allAuthor)->implode(',');
        //translator
        $translator = $request->translator_id;
        if (!empty($translator)) :
            $allTranslator = array();
            foreach ($translator as $key => $value) :
                if (!is_numeric($value)) {
                    $allTranslator[] = $this->saveNewAuthorOrTransalator($value);
                } else {
                    $allTranslator[] = $value;
                }
            endforeach;
            $product->translator_id =  collect($allTranslator)->implode(',');
        endif;

        $slug = Auth::user()->username;
        $publisher_info = \App\Model\Common\Publisher::where('slug', $slug)->first();

        $product->publisher_id = $publisher_info->id;
        $product->isbn = $request->input("isbn", "");
        $product->edition_date = $request->input("edition_date", "");
        $product->number_of_pages = $request->input("number_of_pages", "");
        $product->country_id = $request->input("country_id", "");
        $product->language = 'বাংলা'; //

        $product->seo_title = $request->input("title", "");
        $product->meta_description = $request->input("long_description", "");


        if ($request->image) {
            $maxPost = 10 * 1024;
            $img = SM::sm_image_upload('image', "required|max:$maxPost|mimes:png,gif,jpeg,jpg", 0, 1);
            if (is_array($img) && isset($img['insert_id'])) {
                $product->image = $img['slug'];
            }
        }

        if (isset($request->image_gallery) && $request->image_gallery != '') {
            $product->image_gallery = $request->image_gallery;
        }
        $product->read_a_little = json_encode($request['read_a_little']);

        $slug = trim('durbin-' . str_replace(' ', '-', $request->product_english_title));
        $product->slug = SM::create_uri('products', $slug);
        $product->created_by = SM::current_user_id();

        if ($product->save()) {
            $productId = $product->id;
            if (!empty($request->attribute_id[0])) {
                $data = [];
                foreach ($request->attribute_id as $key => $v) {
                    $data = array(
                        'attribute_id' => $v,
                        'product_id' => $productId,
                        'color_id' => $request->color_id[$key],
                        'attribute_legnth' => $request->attribute_legnth[$key],
                        'attribute_front' => $request->attribute_front[$key],
                        'attribute_back' => $request->attribute_back[$key],
                        'attribute_chest' => $request->attribute_chest[$key],
                        'attribute_qty' => $request->attribute_qty[$key],
                        'attribute_price' => $request->attribute_price[$key],
                        'attribute_image' => $request->attribute_image[$key],
                    );
                    AttributeProduct::insert($data);
                }
                //            $product->attributes()->attach($request->attributes123);
            }




            $allCategory = array();
            foreach ($request->categories as $cat) {
                if (!is_numeric($cat)) {
                    $allCategory[] =  $cat =  $this->saveNewCategory($cat);
                } else {
                    $allCategory[] = $cat;
                    $cat = $cat;
                }
                $categories[$cat]['created_at'] = date("Y-m-d H:i:s");
                $categories[$cat]['updated_at'] = date("Y-m-d H:i:s");
                $catInfo = Category::find($cat);
                if (!empty($catInfo)) {
                    $catInfo->increment("total_products");
                }
            }
            $product->categories()->attach($categories);




            //insert tag as a author


            $seoAuthor = array();
            foreach ($allAuthor as $author) {
                $authorInfo =  Author::findOrFail($author); //collect author info
                if (!empty($authorInfo)) {
                    $seoAuthor[] = $authorInfo->title;
                    $tag = $this->saveTag($authorInfo->title); //insert in tag table
                    $insTags[$tag]['created_at'] = date("Y-m-d H:i:s");
                    $insTags[$tag]['updated_at'] = date("Y-m-d H:i:s");
                    $tagInfo = Tag::find($tag);
                    if (!empty($tagInfo)) {
                        $tagInfo->increment("total_products");
                    }
                }
            }
            $product->tags()->attach($insTags);




            //insert tag as a translator
            $seoTranslator = array();
            if (!empty($allTranslator)) :
                foreach ($allTranslator as $author) {
                    $translatorInfo =  Author::find($author);
                    if (!empty($translatorInfo)) {
                        $seoTranslator[] = $translatorInfo->title;
                        $tag = $this->saveTag($translatorInfo->title);
                        $insTags[$tag]['created_at'] = date("Y-m-d H:i:s");
                        $insTags[$tag]['updated_at'] = date("Y-m-d H:i:s");
                        $tagInfo = Tag::find($tag);
                        if (!empty($tagInfo)) {
                            $tagInfo->increment("total_products");
                        }
                    }
                    // $tagname=$translatorInfo->title;

                }
                $product->tags()->attach($insTags);
            endif;


            $seoCategory = array();
            //insert tag category
            foreach ($allCategory as $cateogry) {
                $categoryInfo =  Category::find($cateogry);
                if (!empty($categoryInfo)) {
                    $seoCategory[] = $categoryInfo->title;
                    $tag = $this->saveTag($categoryInfo->title);
                    $insTags[$tag]['created_at'] = date("Y-m-d H:i:s");
                    $insTags[$tag]['updated_at'] = date("Y-m-d H:i:s");
                    $tagInfo = Tag::find($tag);
                    if (!empty($tagInfo)) {
                        $tagInfo->increment("total_products");
                    }
                }
            }
            $product->tags()->attach($insTags);
            //insert tag as a category name,others

            $seoothertag = array();
            $othersTag = array($product->title, $product->long_description,$product->slug,$product->product_english_title);
            foreach ($othersTag as $others) {
                if (!empty($others)) :
                    $seoothertag[] = $others;
                    $tag = $this->saveTag($others);
                    $insTags[$tag]['created_at'] = date("Y-m-d H:i:s");
                    $insTags[$tag]['updated_at'] = date("Y-m-d H:i:s");
                    $tagInfo = Tag::find($tag);
                    if (!empty($tagInfo)) {
                        $tagInfo->increment("total_products");
                    }
                endif;
            }
            $product->tags()->attach($insTags);

            $metaKey = '';
            if (!empty($seoCategory)) {
                $metaKey .= implode(",", $seoCategory) . ',';
            }
            if (!empty($seoAuthor)) {
                $metaKey .= implode(",", $seoAuthor) . ',';
            }
            if (!empty($seoTranslator)) {
                $metaKey .= implode(",", $seoTranslator) . ',';
            }
            if (!empty($othersTag)) {
                $metaKey .= implode(",", $othersTag) . ',';
            }
            $product->meta_key = $metaKey;
            $product->save();


            $this->removeThisCache();
            return redirect()->route('books');
        } else {
            return redirect()->route('books');
        }
    }

    function saveNewAuthorOrTransalator($new_author_or_translator)
    {
        $author =  new Author();
        $author->title = $new_author_or_translator;
        $author->slug = str_replace(' ', '-', $new_author_or_translator) . '-' . Str::random(5);
        $author->description = $new_author_or_translator;
        $author->seo_title = $new_author_or_translator;
        $author->meta_key = $new_author_or_translator;
        $author->meta_description = $new_author_or_translator;
        $author->status = 2;
        $author->save();
        if ($author) {
            return $author->id;
        }
    }

    function saveTag($tag)
    {
        $taginfo =  new Tag();
        $taginfo->title = $tag;
        $taginfo->slug = str_replace(' ', '-', $tag) . '-' . Str::random(5);
        $taginfo->description = $tag;
        $taginfo->seo_title = $tag;
        $taginfo->meta_key = $tag;
        $taginfo->meta_description = $tag;
        $taginfo->status = 2;
        $taginfo->save();
        if ($taginfo) {
            return $taginfo->id;
        }
    }


    function saveNewCategory($category_name)
    {
        $category = new Category();
        $category->slug = str_replace(' ', '-', $category_name) . '-' . Str::random(5);
        $category->is_featured = 0; // isset($request->is_featured) && $request->is_featured == 'on' ? 1 : 0;
        $category->is_home_page = 0; //isset($request->is_home_page) && $request->is_home_page == 'on' ? 1 : 0;
        $category->is_home_menu = 0; //isset($request->is_home_menu) && $request->is_home_menu == 'on' ? 1 : 0;
        $category->created_by = SM::current_user_id();
        $category->seo_title = $category_name;
        $category->meta_key = $category_name;
        $category->title = $category_name;
        $category->description = $category_name;
        $category->meta_description = $category_name;
        $category->save();
        if ($category) {
            return $category->id;
        }
    }



    public function books()
    {

        $data['activeMenu'] = 'books';
        $data["userInfo"] = \Auth::user();
        $user_info_type  = Auth::user()->type;

        $order_posts_per_page = SM::smGetThemeOption("order_posts_per_page", config('constant.smPagination'));
        // $order_posts_per_page = 2;


        $publisher_info = \App\Model\Common\Publisher::where('slug', Auth::user()->username)->first();


        $data["orders"] = Product::where("publisher_id", $publisher_info->id)
            ->orderBy("id", 'desc')
            ->paginate($order_posts_per_page);

        return view("customer/books", $data);
    }

    public function published_books()
    {

        $data['activeMenu'] = 'published_books';
        $data["userInfo"] = \Auth::user();
        $user_info_type  = Auth::user()->type;

        $order_posts_per_page = SM::smGetThemeOption("order_posts_per_page", config('constant.smPagination'));
        // $order_posts_per_page = 2;


        $publisher_info = \App\Model\Common\Publisher::where('slug', Auth::user()->username)->first();

        $data["orders"] = Product::where("publisher_id", $publisher_info->id)
            ->where("status", '1')
            ->orderBy("id", 'desc')
            ->paginate($order_posts_per_page);



        return view("customer/books", $data);
    }



    public function books_short_stock()
    {

        $data['activeMenu'] = 'books_short_stock';
        $data["userInfo"] = \Auth::user();
        $user_info_type  = Auth::user()->type;

        $order_posts_per_page = SM::smGetThemeOption("order_posts_per_page", config('constant.smPagination'));
        $publisher_info = \App\Model\Common\Publisher::where('slug', Auth::user()->username)->first();

        $data["orders"] = Product::where("publisher_id", $publisher_info->id)
            ->where('product_qty', '<=', 5)
            ->orderBy("id", 'desc')
            ->paginate($order_posts_per_page);



        return view("customer/books", $data);
    }

    public function publisher_orders()
    {

        $data['activeMenu'] = 'publisher_orders';
        $data["userInfo"] = \Auth::user();
        $user_info_type  = Auth::user()->type;

        $order_posts_per_page = SM::smGetThemeOption("order_posts_per_page", config('constant.smPagination'));

        $publisher_info = \App\Model\Common\Publisher::where('slug', Auth::user()->username)->first();
        $publisher_book_list = \App\Model\Common\Product::where('publisher_id', $publisher_info->id)->get();
        $books = array();
        if (!empty($publisher_book_list)) {

            foreach ($publisher_book_list as $key => $value) {
                array_push($books, $value->id);
            }
        }

        $data["orders"] = DB::table('order_details')
            ->whereIn('product_id', $books)
            ->orderBy("id", 'desc')
            ->paginate($order_posts_per_page);
        return view("customer/publisher_order", $data);
    }
    public function publisher_orders_today()
    {

        $data['activeMenu'] = 'publisher_orders_today';
        $data["userInfo"] = \Auth::user();
        $user_info_type  = Auth::user()->type;

        $order_posts_per_page = SM::smGetThemeOption("order_posts_per_page", config('constant.smPagination'));

        $publisher_info = \App\Model\Common\Publisher::where('slug', Auth::user()->username)->first();
        $publisher_book_list = \App\Model\Common\Product::where('publisher_id', $publisher_info->id)->get();
        $books = array();
        if (!empty($publisher_book_list)) {

            foreach ($publisher_book_list as $key => $value) {
                array_push($books, $value->id);
            }
        }

        $data["orders"] = DB::table('order_details')
            ->whereIn('product_id', $books)
            ->whereDate('created_at', date('Y-m-d'))
            ->orderBy("id", 'desc')
            ->paginate($order_posts_per_page);
        return view("customer/publisher_order", $data);
    }
    public function return_back()
    {
        return back();
    }

    public function books_delete($id)
    {

        $product = Product::with('categories', 'tags')->find($id);
        if (!empty($product)) {
            if (!empty($product->categories)) {
                foreach ($product->categories as $category) {
                    if ($category->total_products > 0) {
                        $category->decrement('total_products');
                    }
                }
            }
            if (!empty($product->tags)) {
                foreach ($product->tags as $tag) {
                    if ($tag->total_products > 0) {
                        $tag->decrement('total_products');
                    }
                }
            }

            $product->categories()->detach();
            $this->removeThisCache($product->slug, $product->id);

            if ($product->delete() > 0) {
                return back()->with('s_message', 'Product Is deleted');
            }
        }

        return back()->with('w_message', 'You can not delete this product');
    }
    public function removeThisCache($slug = null, $id = null)
    {
        SM::removeCache('homeLatestDealsProducts');
        SM::removeCache('homeRecommendedProducts');
        SM::removeCache('sidebar_popular_product');
        if ($slug != null) {
            SM::removeCache('product_' . $slug);
            SM::removeCache('product_related_product_' . $slug);
        }
        if ($id != null) {
            SM::removeCache(['product_comments_count_' . $id], 1);
            SM::removeCache(['product_comments_' . $id], 1);
        }
        SM::removeCache(['categoryProducts'], 1);
        SM::removeCache(['tagProducts'], 1);
        SM::removeCache(['products'], 1);
        SM::removeCache(['stickyProducts'], 1);
    }


    /**
     * Show customer orders
     *
     * @param null $status
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orders($status = null)
    {



        $data['activeMenu'] = 'orders';
        $data["userInfo"] = $userInfo = \Auth::user();


        if($userInfo->type == 'publisher'):

         $orderIds = $this->publisherOrderId();
        $order_posts_per_page = SM::smGetThemeOption("order_posts_per_page", config('constant.smPagination'));
        $data['status'] = $status;
        if ($status != null) {
            $data["orders"] = Order::where("order_status", $status)
            ->whereIn('id',$orderIds)
                ->orderBy("id", 'desc')
                ->paginate($order_posts_per_page);
        } else {
            $data["orders"] = Order::whereIn('id',$orderIds)
                ->orderBy("id", 'desc')
                ->paginate($order_posts_per_page);
        }

    else:

        $order_posts_per_page = SM::smGetThemeOption("order_posts_per_page", config('constant.smPagination'));
        $data['status'] = $status;
        if ($status != null) {
            $data["orders"] = Order::where("user_id", \Auth::user()->id)
                ->where("order_status", $status)
                ->orderBy("id", 'desc')
                ->paginate($order_posts_per_page);
        } else {
            $data["orders"] = Order::where("user_id", \Auth::user()->id)
                ->orderBy("id", 'desc')
                ->paginate($order_posts_per_page);
        }



    endif;



        return view("customer/orders", $data);
    }

    public function wishlist()
    {
        $data['activeMenu'] = 'wishlist';
        $data["userInfo"] = \Auth::user();
        $order_posts_per_page = SM::smGetThemeOption("order_posts_per_page", config('constant.smPagination'));

        $data["wishlists"] = Wishlist::where("user_id", Auth::id())
            ->orderBy("id", 'desc')
            ->paginate($order_posts_per_page);

        return view("customer/wishlist", $data);
    }



    public function review()
    {
        $data['activeMenu'] = 'review';
        $data["userInfo"] = \Auth::user();
        $order_posts_per_page = SM::smGetThemeOption("order_posts_per_page", config('constant.smPagination'));

        $data["reviews"] = Review::where("user_id", Auth::id())
            ->orderBy("id", 'desc')
            ->paginate($order_posts_per_page);

        return view("customer.review", $data);
    }

    /**
     * show customer order details by id
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function detailOrders($id)
    {
        Cart::instance('cart')->destroy();
        $data["order"] = Order::with('payment', 'user', 'detail')
            ->where("user_id", \Auth::user()->id)
            ->find($id);
        if (!empty($data["order"])) {
            $data["payment"] = $data["order"]->payment;

            //            return view("pdf/invoice", $data);
            return view("customer/order_detail", $data);
        } else {
            return abort(404);
        }
    }



    /**
     * Download order invoice pdf by id
     *
     * @param $id
     */
    // public function downloadOrders($id)
    // {
    //     $data["order"] = Order::with('payment', 'user', 'detail')
    //         ->where("user_id", \Auth::user()->id)
    //         ->find($id);
    //     if (count($data["order"]) > 0) {
    //         $data["payment"] = Payment::find($data["order"]->payment_id);

    //         $view = view("pdf/invoice", $data);

    //         return PDF::loadHTML($view)
    //             ->download('mahmud_mart_invoice_' . SM::orderNumberFormat($data["order"]) . '.pdf');
    //     } else {
    //         return abort(404);
    //     }
    // }

    public function downloadOrders($id)
    {
        // $data["order"] = Order::with('payment', 'user', 'detail')
        //     ->where("user_id", \Auth::user()->id)
        //     ->find($id);
        // if (count($data["order"]) > 0) {
        //     $data["payment"] = Payment::find($data["order"]->payment_id);
        //     $view = view("pdf/invoice", $data);
        //     // return $view;
        // } else {
        //     return abort(404);
        // }

        $data["order"] = Order::with('payment', 'user', 'detail')->where("user_id", \Auth::user()->id)->find($id);

        // dd($data);
        if (!empty($data["order"])) {
            $data["payment"] = Payment::find($data["order"]->payment_id);

            // dd($data);
            return view("pdf/invoice", $data);
        } else {
            return abort(404);
        }
    }

    /**
     * Edit customer profile
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editProfile()
    {
        $data['activeMenu'] = 'edit-profile';
        $data["userInfo"] = \Auth::user();

        return view("customer/edit-profile", $data);
    }

    /**
     * Save customer profile info
     *
     * @param Request $data
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveProfile(Request $data)
    {
        $this->validate($data, [
            'name' => 'required|max:55|min:2',
            'address' => 'required|max:55|min:2',
            'city' => 'required|max:55|min:2',
            'zip' => 'required|max:55|min:2',
            'state' => 'required|max:55|min:2',
            'country' => 'required|max:55|min:2',
        ]);
        $user = \Auth::user();
        $user->mobile = isset($data['mobile']) ? $data['mobile'] : null;
        $user->street = isset($data['address']) ? $data['address'] : null;
        $user->city = isset($data['city']) ? $data['city'] : null;
        $user->zip = isset($data['zip']) ? $data['zip'] : null;
        $user->state = isset($data['state']) ? $data['state'] : null;
        $user->country = isset($data['country']) ? $data['country'] : null;

        $user->firstname = isset($data['name']) ? $data['name'] : null;
        $user->update();

        //        $value = isset($data['skype']) ? $data['skype'] : null;
        //        SM::update_front_user_meta(\Auth::user()->id, 'skype', $value);

        return back()->with('s_message', "Profile Successfully updated!");
    }

    /**
     * Save customer profile picture
     *
     * @param Request $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveProfilePicture(Request $data)
    {


        $maxPost = config('constant.smPostMaxInMb') * 1024;
        $img = SM::sm_image_upload('profile_picture', "required|max:$maxPost|mimes:png,gif,jpeg", 0, 0);
        if (is_array($img) && isset($img['insert_id'])) {
            $user = \Auth::user();
            $user->image = $img['slug'];
            $user->update();

            return response()->json($img, 200);
        } else {
            return response()->json($img, 403);
        }
    }

    /**
     * Update customer password
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {


        if (!empty($request->password) || !empty($request->current_password)) {

            //update with password
            $this->validate($request, [
                'password' => 'required|min:6|max:20|confirmed',
                'current_password' => 'required|min:6|max:20'
            ]);
            $user = \Auth::user();
            $old_user_name = $user->username;
            if (Hash::check($request->current_password, $user->password)) {

                $user->password = bcrypt($request->password);
                $user->username = $request->username;
                $user->email = $request->useremail;
                $user->update();
                if (Auth::user()->type == "publisher") {
                    $publisher_info = \App\Model\Common\Publisher::where('slug', $old_user_name)->first();
                    $data['slug'] = $request->username;
                    Publisher::where('id', $publisher_info->id)->update($data);
                }
                return back()->with('s_message', "Account Information Successfully Changed!");
            } else {
                return back()->with('w_message', "Password not Changed due to miss match current password!");
            }
        } else {


            $this->validate($request, [
                'username' => 'required|max:55|unique:users,username,' . Auth::user()->id,
                'useremail' =>    'required|max:55|unique:users,email,' . Auth::user()->id
            ]);

            $user = \Auth::user();
            $old_user_name = $user->username;
            $user->username = $request->username;
            $user->email = $request->useremail;
            $user->update();
            if (Auth::user()->type == "publisher") {
                $publisher_info = \App\Model\Common\Publisher::where('slug', $old_user_name)->first();
                $data['slug'] = $request->username;
                Publisher::where('id', $publisher_info->id)->update($data);
            }
            return back()->with('s_message', "Account Information Successfully Changed!");
        }
    }

    /**
     * Show all downloadable file
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function downloads()
    {
        $data['activeMenu'] = 'downloads';
        $data["userInfo"] = \Auth::user();
        $order_posts_per_page = SM::smGetThemeOption("order_posts_per_page", config('constant.smPagination'));
        $data["medias"] = Media::leftJoin('media_permissions', 'media_permissions.media_id', '=', "media.id")
            ->where("media_permissions.user_id", \Auth::user()->id)
            ->orderBy('media.id', 'desc')
            ->paginate($order_posts_per_page);

        return view("customer/downloads", $data);
    }

    /**
     * Download customer order files
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function mediaDownload($id)
    {
        $media = Media::find($id);
        if (count($media) > 0) {
            $path = config('constant.smUploadsDir');
            $fileWithDir = storage_path("app/" .
                ($media->is_private == 1 ? "private" : "public") .
                "/" . $path . $media->slug);
            if (file_exists($fileWithDir)) {
                if ($media->is_private == 0) {
                    return Response::download($fileWithDir);
                } elseif (Media_permissions::where('user_id', \Auth::user()->id)->where('media_id', $id)->first()) {
                    return Response::download($fileWithDir);
                }
            }

            return back()->with('w_message', 'No file Found!');
        }
    }
}