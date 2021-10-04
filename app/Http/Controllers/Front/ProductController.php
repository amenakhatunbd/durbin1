<?php



namespace App\Http\Controllers\Front;



use App\Model\Common\Attribute;

use App\Model\Common\Author;

use App\Model\Common\Brand;

use App\Model\Common\Category;

use App\Model\Common\Product;

use App\Model\Common\Publisher;
use App\Model\Common\Review;

use App\Model\Common\Tag;

use App\Model\Common\RecentProductView;

use App\SM\SM;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Cart;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use App\Model\Common\AttributeProduct;

use Illuminate\Database\Eloquent\Builder;



class ProductController extends Controller

{



    public function shop(Request $request, $slug = null)

    {

      


        $data['type'] = request()->get('type');

        $data['seo_title'] = SM::smGetThemeOption("product_seo_title");

        $data['meta_key'] = SM::smGetThemeOption("product_meta_keywords");

        $data['meta_description'] = SM::smGetThemeOption("product_meta_description");

        return view('frontend.products.shop', $data);

    }
    public function mamun_price()
    {
        
        
        
        $data = DB::table("products")->get();
        foreach($data as $value)
        {
          
            // $author_id = '["'.$value->author_id.  '"]';
            dd($value->author_id);
            $listString = explode('["', $value->author_id);
            $listString = explode('"]', $listString[1]);
            $listString= $listString[0];
         
            
            DB::table('products')
            ->where('id', $value->id)  
            ->update(array('author_id' => $listString)); 
        }
    }


    function product_search_data(Request $request)

    {
    



       

        if ($request->ajax()) {

            $output = '';

            $action = $request->action;

            $type = $request->type;

            $brand_filter = $request->brand;

            $author_filter = $request->author;



            $publisher_filter = $request->publisher;

            $size_filter = $request->size;

            $color_filter = $request->color;

            $category_id = $request->category;

            if (!empty($request->category)) {

                $category_titles = Category::whereIn('id', $request->category)->get();

                if (count($category_titles) > 0) {

                    $category_result = "";

                    foreach ($category_titles as $category_title) {

                        $category_result .= $category_title->title . ', ';

                    }

                    $category_filter_title = '<strong></strong>' . rtrim($category_result, ', ');

                }

            } else {

                if (!empty($type)) {

                    $category_filter_title = array('<strong>Best Sale Products</strong>');

                } else {

                    $category_filter_title = array('<strong>Shop</strong>');

                }



            }

            if (!empty($request->brand)) {

                $brand_titles = Brand::whereIn('id', $request->brand)->get();

                if (count($brand_titles) > 0) {

                    $brand_result = "";

                    foreach ($brand_titles as $brand_title) {

                        $brand_result .= $brand_title->title . ', ';

                    }

                    $brand_filter_title = '| <strong>Brands</strong>: ' . rtrim($brand_result, ', ');

                }

            } else {

                $brand_filter_title = array();

            }

            if (!empty($request->author)) {

                $author_titles = Author::whereIn('id', $request->author)->get();

                if (count($author_titles) > 0) {

                    $author_result = "";

                    foreach ($author_titles as $author_title) {

                        $author_result .= $author_title->title . ', ';

                    }

                    $author_filter_title = '| <strong>Authors</strong>: ' . rtrim($author_result, ', ');

                }

            } else {

                $author_filter_title = array();

            }

            if (!empty($request->publisher)) {

                $publisher_titles = Publisher::whereIn('id', $request->publisher)->get();

                if (count($publisher_titles) > 0) {

                    $publisher_result = "";

                    foreach ($publisher_titles as $publisher_title) {

                        $publisher_result .= $publisher_title->title . ', ';

                    }

                    $publisher_filter_title = '| <strong></strong>' . rtrim($publisher_result, ', ');

                }

            } else {

                $publisher_filter_title = array();

            }

            $category_filter = array();

            $category_filter[] = $category_id;

            if ($category_id != '') {

                foreach ($category_id as $cat_id) {

                    $subcategory_id = Category::where('parent_id', $cat_id)->get();

                    if (count($subcategory_id) > 0) {

                        foreach ($subcategory_id as $item) {

                            $category_filter[] = $item->id;

                        }

                    } else {

                        $category_filter[] = $cat_id;

                    }

                }

            } else {

                $category_filter = $request->category;

            }





            $on_change_product_filter = $request->onChangeProductFilter[0];

            $orderByPrice = "";

            if ($on_change_product_filter == 5) {

                $orderByPrice = 'asc';

            } elseif ($on_change_product_filter == 6) {

                $orderByPrice = 'desc';

            }

            if ($on_change_product_filter == 1) {

                $orderByName = 'asc';

            } else {

                $orderByName = '';

            }

            if ($on_change_product_filter == 2) {

                $orderByNew = 'desc';

            } else {

                $orderByNew = '';

            }

            if ($on_change_product_filter == 3) {

                $orderByBestSellers = 'desc';

            } else {

                $orderByBestSellers = '';

            }

            if ($on_change_product_filter == 4) {

                $orderByView = 'desc';

            } else {

                $orderByView = '';

            }





            $limit_filter = $request->limitProduct;

            if ($limit_filter == 10) {

                $limit = 10;

            } elseif ($limit_filter == 18) {

                $limit = 18;

            } elseif ($limit_filter == 20) {

                $limit = 20;

            } elseif ($limit_filter == 50) {

                $limit = 50;

            } elseif ($limit_filter == 100) {

                $limit = 100;

            } else {

                $limit = 10;

            }

            $shop_page_per_product = SM::smGetThemeOption(

                "shop_page_per_product", config("constant.smFrontPagination"

            ));

            if (isset($request["minimum_price"], $request["maximum_price"]) && !empty($request["minimum_price"]) && !empty($request["maximum_price"])) {

                $minimum_price = $request["minimum_price"];

                $maximum_price = $request["maximum_price"];

            } else {

                $minimum_price = '';

                $maximum_price = '';

            }

            if (isset($request["minimum_price"], $request["maximum_price"]) && !empty($request["minimum_price"]) && !empty($request["maximum_price"])) {

                $minimum_price = $request["minimum_price"];

                $maximum_price = $request["maximum_price"];

            } else {

                $minimum_price = '';

                $maximum_price = '';

            }



            $product_data = DB::table('products')

                ->join('categoryables', 'products.id', 'categoryables.categoryable_id')
                ->leftJoin('attribute_product', 'products.id', 'attribute_product.product_id')
                ->leftJoin('order_details', 'products.id', 'order_details.product_id')
                ->leftJoin('authors', 'authors.id', 'products.author_id')
                ->where('categoryables.categoryable_type', 'App\Model\Common\Product')
                ->where('products.status', 1)
                ->orderBy('id', 'DESC')
                ->select('products.*','authors.title as authorname', 'categoryables.category_id', DB::raw('SUM(products.views) as totalView, SUM(order_details.product_id) as bestSellers'));

            if ($brand_filter != "") {

                $product_data->whereIn('products.brand_id', $brand_filter);

            }

            if ($author_filter != "") {

                $product_data->whereIn('products.author_id', $author_filter);
            }

            if (!empty($publisher_filter)) {

                $product_data->whereIn('products.publisher_id', $publisher_filter);

            }

            if ($category_filter != "") {

                $product_data->whereIn('categoryables.category_id', $category_filter);

            }

            if ($minimum_price != "" && $maximum_price != "") {

                $product_data->whereBetween('products.regular_price', array($minimum_price, $maximum_price));

            }

            if ($size_filter != "") {

                $product_data->whereIn('attribute_product.attribute_id', $size_filter);

            }

            if ($color_filter != "") {

                $product_data->whereIn('attribute_product.color_id', $color_filter);

            }

            if ($orderByPrice != "") {

                $product_data->orderBy('regular_price', $orderByPrice);

            }

            if ($orderByName != "") {

                $product_data->orderBy('title', $orderByName);

            }

            if ($orderByNew != "") {

                $product_data->orderBy('id', $orderByNew);

            }

            if ($orderByBestSellers != "") {

                $product_data->orderBy('bestSellers', $orderByBestSellers);

            }

            if ($orderByView != "") {

                $product_data->orderBy('totalView', $orderByView);

            }

            // ->orderBy('categoryables.category_id')

//                ->orderBy('products.brand_id')

            $product_data = $product_data->groupBy('products.id')

                ->paginate(12);






               // dd($product_data);

//                 var_dump(count($product_data));

//                 exit;



            if (count($product_data) > 0) {
                $output .= '<div class="row">';
                foreach ($product_data as $product) {
                    $des_count = 0;
                    $des_count = SM::productDiscount($product->id);
                    $output .= ' 
                    <div class="col-md-3 col-sm-6 col-xs-6 pad-no">
                        <div class="panel-book-box mar-bot-20" >
                            <a href="' . url('book/' . $product->slug) . '">
                                <img alt="' . $product->title . '" src="' . SM::sm_get_the_src($product->image, 160, 200) . '"> ';
                                if ($des_count > 0) {
                                    $output .= '<div class="discount-badge">
                                        <p>' . $des_count . ' % <small>OFF</small></p>
                                    </div> ';
                                }
                                $output .= ' <div class="book-text-area">
                                    <p class="book-title">' . $product->title . '</p>' ;
                                   $output .='<p class="author-title">'.$product->authorname.'</p>';
                                    $output .= '<p class="book-price">';
                                    if ($product->sale_price > 0) {
                                        $output .= '<strike class="original-price">' . SM::currency_price_value($product->regular_price) . '</strike>' . SM::currency_price_value($product->sale_price);
                                    } else {
                                        $output .= SM::currency_price_value($product->regular_price);
                                    }
                                    $output .= SM::addToCartButton($product->id, $product->regular_price, $product->sale_price);
                                    $output .= '</p>
                                    </div>
                                </a>
                            </div>
                        </div>  
                    ';
                }

                $output .= '
                    <div class="clearfix"></div> 
                        <div class="col-md-12 pad-no">
                            <div id="shop_search_pagination">
                                ' . $product_data->links() . '
                            </div> 
                            <div class="item-list-count">
                                Showing ' . $product_data->firstItem() . '-' . $product_data->lastItem() . '
                                of ' . $product_data->total() . '     
                            </div>
                        </div>   
                    </div>';
                } else {
                    $output = '<div class="alert alert-info"><i class="fa fa-info"></i> No Product Found!</div>';
                }
                $files = array(
                    'product_filter_data' => $output,
                    'category_filter_data' => $category_filter_title,
                    'publisher_filter_data' => $publisher_filter_title,
                );
                return Response($files);
            }
        }

    public function main_search(Request $request)

    {

        $search_text = $request->input('search_text');

        $this->getProductSearchData($search_text);

        

       

    }



    private function getProductSearchData($searchtext)

    {



     


        $word_count = str_word_count($searchtext);

        if ($word_count > 1) {

            $text = str_replace(' ', '%', $searchtext);

        } else {

            $text = $searchtext;

        }

        $search_page_per_product = SM::smGetThemeOption(

            "search_page_per_product", config("constant.smFrontPagination"

        ));

        $output = '';
        
        //  $mysqlQuery = "SELECT * FROM `products` 
        //                 JOIN `taggables` on products.id = taggables.taggable_id
        //                 JOIN `tags` ON tags.id = taggables.tag_id
        //                 where products.title LIKE '%{$text}%' 
        //                 OR tags.title LIKE '%{$text}%' 
        //                 OR products.short_description LIKE '%{$text}%'
        //                 OR products.long_description LIKE '%{$text}%'
        //                 AND products.status = 1";
                        
        // $product_data = DB::select(DB::raw($mysqlQuery));       

        // $product_data = DB::table('products')
        $product_data = Product::with('tags', 'author', 'publisher')

            ->where('status', '=', 1)

            ->where('title', 'like', '%' . $text . '%')
            ->orWhere('product_english_title', 'like', '%' . $text . '%')
            ->orWhere(function ($query) use ($text) {

                $query->where('status', '=', 1)

                    ->where('short_description', 'like', '%' . $text . '%');

            })

            ->orWhere(function ($query) use ($text) {

                $query->where('status', '=', 1)

                    ->where('long_description', 'like', '%' . $text . '%');

            })
            
            // ->orWhere(function ($query) use ($text) {
            //     $query->where('tags.title', 'like', '%' . $text . '%');
            // })
            
            ->orWhereHas('tags', function (Builder $query) use ($text) {
                $query->where('title', 'like', '%' . $text . '%');
            })
            
            ->orWhereHas('author', function (Builder $query) use ($text) {
                $query->where('title', 'like', '%' . $text . '%');
            })
            
            ->orWhereHas('publisher', function (Builder $query) use ($text) {
                $query->where('title', 'like', '%' . $text . '%');
            })
            
            ->orderBy('brand_id')->limit(48)

            ->get();



           // dd($product_data);
            // ->get();
            
            // return $product_data;



        // $product_data = Product::Published()

        // ->where("title", "like", "%" . $text . "%")

        // ->orWhere("short_description", "like", "%" . $text . "%")

        // ->orWhere("long_description", "like", "%" . $text . "%")

        // ->orWhere("sku", "like", "%" . $text . "%")

        // ->orderBy('brand_id')

        // ->paginate($search_page_per_product);



        if (count($product_data) > 0) {

            $output .= '<section>

        <div class="container">
            <div class="all-sell-intem-box" style="padding-bottom: 50px">
                <div class="all-sale-slide all-caro-btn">';

            foreach ($product_data as $product) {

                $des_count = 0;

                $title = $product->title ?? '';
                $author = $product->author->title ?? '';

                $des_count = SM::productDiscount($product->id);

                $output .= ' 

                            <div class="col-md-2 pad-no col-xs-6">

                                <div class="panel-book-box mar-bot-20">

                                    <a href="' . url('book/' . $product->slug) . '">

                                        <img alt="' . $title . '" src="' . SM::sm_get_the_src($product->image, 160, 200) . '" class="img-responsive">

                                        ';

                if ($des_count > 0) {

                    $output .= '<div class="discount-badge">

                                            <p>' . $des_count . ' <small>OFF</small></p>

                                        </div> ';

                }

                $output .= ' <div class="book-text-area">

                                            <p class="book-title">' . $title . '</p>
                                            <p class="author-title">' . $author . '</p>



                                            <p class="book-price">';

                if ($product->sale_price > 0) {

                    $output .= '<strike class="original-price">' . SM::currency_price_value($product->regular_price) . '</strike>' . SM::currency_price_value($product->sale_price);

                } else {

                    $output .= SM::currency_price_value($product->regular_price);

                }

                $output .= '</p>
                <div class="mobile-btn-custom">
                                                        <a data-product_id="'.$product->id.'" class="addToCart btn btn-warning button-absotalate">Add to cart</a>
                                                    </div>

                                        </div>

                                    </a>

                                </div>

                            </div>  

                           ';

            }

            

        } else {

            $output = '<section>

        <div class="container"><div class="alert alert-info"><i class="fa fa-info"></i> No Product Found!</div></div>

                            </section>';

        }

        echo $output;

    }



    /**

     * Product detail page show by slug

     *

     * @param $slug string

     *

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void

     */
     
     private function saveAuthuserRecentView($user_id, $product_id){

        // dd(\Request::getClientIp(true));

        $data = array(
            'user_id' => $user_id,
            'ip_address' => \Request::getClientIp(true), // request()->ip();
            'product_id' => $product_id,
        );

        $result = RecentProductView::insert($data);

        return $result;
    }

    public function productDetail($slug)

    {




        $data["product"] = SM::getCache('product_' . $slug, function () use ($slug) {

            return Product::with("categories", "user")

                ->where("slug", $slug)

                ->where("status", 1)

                ->first();

        });

//        if (count($data["product"]) > 0) {

        if (!empty($data["product"])) {

            $data['smAdminBarId'] = $data["product"]->id;



            $data["product"]->increment("views");



            $data["relatedProduct"] = SM::getCache('product_related_product_' . $slug, function () use ($data) {

                $product_related_per_page = SM::smGetThemeOption("product_related_per_page", 6);

                $cats = SM::get_ids_from_data($data['product']->categories);



                return DB::table("products")

                    ->select('products.*')

                    ->join("categoryables", function ($join) {

                        $join->on("categoryables.categoryable_id", "=", "products.id")

                            ->where("categoryables.categoryable_type", '=', 'App\Model\Common\Product');

                    })

                    ->whereIn("categoryables.category_id", $cats)

                    ->where("products.id", '!=', $data["product"]->id)

                    ->where("products.status", 1)

                    ->orderBy("products.id", "desc")

                    ->limit($product_related_per_page)

                    ->groupBy('products.id')

                    ->get();

            });
        //   $review = Review::select(DB::raw('count(*) as total,avg(rating) as totalRating'))->where('product_id',$data["product"]->id)->where('status',1)->groupBy('product_id')->first();
        // dd($review);
        $data['review'] = Review::select(DB::raw('count(*) as total,avg(rating) as totalRating'))->where('product_id',$data["product"]->id)->where('status',1)->groupBy('product_id')->first();

//            var_dump($data["relatedProduct"]);

//            exit();

            $product_related_per_page = SM::smGetThemeOption("product_related_per_page", 5);

            $cats = SM::get_ids_from_data($data['product']->categories);





            /**

             * If related product not found then show post from all post

             */

//            if (count($data["relatedProduct"]) < 1) {

//                $data["relatedProduct"] = SM::getCache('product_related_all_product_' . $slug, function () use ($data) {

//                    $product_related_per_page = SM::smGetThemeOption("product_related_per_page", 2);

//

//                    return DB::table("products")

//                        ->select('products.*')

//                        ->join("users", 'products.created_by', '=', 'users.id')

//                        ->where("products.id", '!=', $data["product"]->id)

//                        ->where("products.status", 1)

//                        ->orderBy("products.id", "desc")

//                        ->limit($product_related_per_page)

//                        ->get();

//                });

//                $product_related_per_page = SM::smGetThemeOption("product_related_per_page", 5);

//            }





            $data['seo_title'] = $data['product']->seo_title;

            $data["meta_key"] = $data["product"]->meta_key;

            $data["meta_description"] = $data["product"]->meta_description;

            $data["image"] = asset(SM::sm_get_the_src($data["product"]->image, 750, 560));
            
            // if(Auth::check()){
            //     if(Auth::user()->id){
            //         if($data["product"]->id){
            //             $this->saveAuthuserRecentView(Auth::user()->id, $data["product"]->id);
            //         }
            //     }
            // }

            return view('frontend.products.product_detail', $data);

        } else {

            return abort(404);

        }

    }



    public function categoryType_filter_by_product(Request $request)

    {

        if ($request->ajax()) {

            $output = "";

            $type = $request->type;

            $category_id = $request->category_id;

            $subcat_id[] = $category_id;

            $subcategory_id = Category::where('parent_id', $category_id)->get();

            if (!empty($subcategory_id)) {

                foreach ($subcategory_id as $item) {

                    $subcat_id[] = $item->id;

                }

            }



            if ($type == 'specials') {

                $get_products = DB::table('products')

                    ->join('categoryables', 'products.id', 'categoryables.categoryable_id')

                    ->leftJoin('reviews', 'products.id', 'reviews.product_id')

                    ->where('categoryables.categoryable_type', 'App\Model\Common\Product')

                    ->where('products.sale_price', '>', 0)

                    ->whereIn('categoryables.category_id', $subcat_id)

                    ->groupBy('products.id')

                    ->select('products.*')

                    ->take(7)

                    ->get();

            } elseif ($type == 'best_sales') {

                $get_products = DB::table('products')

                    ->join('categoryables', 'products.id', 'categoryables.categoryable_id')

                    ->leftJoin('order_details', 'products.id', 'order_details.product_id')

                    ->where('categoryables.categoryable_type', 'App\Model\Common\Product')

                    ->whereIn('categoryables.category_id', $subcat_id)

                    ->select('products.*', DB::raw('COUNT(order_details.product_id) as count'))

                    ->groupBy('products.id')

                    ->orderBy('count', 'desc')

                    ->take(7)

                    ->get();

            } elseif ($type == 'most_reviews') {

                $get_products = DB::table('products')

                    ->join('categoryables', 'products.id', 'categoryables.categoryable_id')

                    ->leftJoin('reviews', 'products.id', 'reviews.product_id')

                    ->where('categoryables.categoryable_type', 'App\Model\Common\Product')

                    ->where('reviews.status', 1)

                    ->whereIn('categoryables.category_id', $subcat_id)

                    ->groupBy('products.id')

                    ->selectRaw('products.*, sum(reviews.rating) as totalRating')

                    ->orderBy('totalRating', 'desc')

                    ->take(7)

                    ->get();

            } else {

                $get_products = DB::table('products')

                    ->join('categoryables', 'products.id', 'categoryables.categoryable_id')

                    ->where('categoryables.categoryable_type', 'App\Model\Common\Product')

                    ->whereIn('categoryables.category_id', $subcat_id)

                    ->select('products.*')

                    ->orderBy('products.id', 'desc')

                    ->groupBy('products.id')

                    ->take(7)

                    ->get();

            }





            if (count($get_products) > 0) {

                $output .= '<div class="box-left">';

                foreach ($get_products->take(1) as $first_product) {

                    $output .= '<div class="banner-img">

                                                <a title="' . $first_product->title . '"

                                                   href="' . url('book/' . $first_product->slug) . '"><img

                                                            src="' . SM::sm_get_the_src($first_product->image, 450, 650) . '"

                                                            alt="' . $first_product->title . '"></a>

                                            </div>';

                }

                $output .= ' </div>

                                                <div class="box-right">

                                                    <ul class="product-list row">';

                foreach ($get_products as $pKey => $product) {

                    if ($pKey > 0) {

                        if ($product->product_type == 2) {

                            $att_data = SM::getAttributeByProductId($product->id);

                            if (!empty($att_data->attribute_image)) {

                                $attribute_image = $att_data->attribute_image;

                            } else {

                                $attribute_image = $product->image;

                            }

                            $output .= ' <li class="col-sm-4">

                                                <div class="left-block">

                                                    <a href="' . url('book/' . $product->slug) . '">

                                                        <img title="' . $product->title . '"

                                                             class="img-responsive"

                                                             alt="' . $product->title . '"

                                                             src="' . SM::sm_get_the_src($attribute_image, 206, 251) . '"/>

                                                    </a>

                                                    <div class="quick-view">';

                            $output .= SM::quickViewHtml($product->id, $product->slug) . '

                                                    </div>

                                                    <div class="add-to-cart">

                                                   ' . SM::addToCartButton($product->id, $product->regular_price, $product->sale_price) . '

                                                    </div>

                                                </div>

                                                <div class="right-block">

                                                    <h5 class="product-name">

                                                        <a href="' . url('book/' . $product->slug) . '">

                                                            ' . $product->title . '

                                                        </a>

                                                    </h5>

                                                    <div class="content_price">

                                                        <span class="price product-price">' . SM::currency_price_value($att_data->attribute_price) . '</span>



                                                    </div>

                                                </div>

                                            </li>';

                        } else {

                            $output .= ' <li class="col-sm-4">

                                                <div class="left-block">

                                                    <a href="' . url('book/' . $product->slug) . '">

                                                        <img title="' . $product->title . '"

                                                             class="img-responsive"

                                                             alt="' . $product->title . '"

                                                             src="' . SM::sm_get_the_src($product->image, 206, 251) . '"/>

                                                    </a>

                                                    <div class="quick-view">';

                            $output .= SM::quickViewHtml($product->id, $product->slug) . '

                                                    </div>

                                                    <div class="add-to-cart">

                                                   ' . SM::addToCartButton($product->id, $product->regular_price, $product->sale_price) . '

                                                    </div>

                                                </div>

                                                <div class="right-block">

                                                    <h5 class="product-name">

                                                        <a href="' . url('book/' . $product->slug) . '">

                                                            ' . $product->title . '

                                                        </a>

                                                    </h5>

                                                      <h6 class="text-center wait-st-unit"><span>' . $product->product_weight . '</span>' . SM::product_wait_unit($product->unit_id)->title . '</h6>

                                                    <div class="content_price">';

                            if ($product->sale_price > 0) {

                                $output .= '<span class="price product-price">' . SM::currency_price_value($product->sale_price) . '</span>

                                                            <span class="price old-price">' . SM::currency_price_value($product->regular_price) . '</span>

                                                            <input type="hidden" id="price"  value="' . $product->sale_price . '"/>';

                            } else {

                                $output .= ' <span class="price product-price">' . SM::currency_price_value($product->regular_price) . '</span>

                                                            <input type="hidden" id="price" value="' . $product->regular_price . '"/>';

                            }



                            $output .= '</div>

                                                </div>

                                            </li>';

                        }

                    }

                }

                $output .= ' </ul>

                                                </div>';





                return Response($output);

            } else {

                $output = '<p style="font-size:18px;color: red; padding: 5px; margin-top: 20px;">Not data found</p>';

                return Response($output);

//                return Response()->json([d => 'Not data found']);

            }

        }

    }



    public function product_color_by_size(Request $request)

    {

        if ($request->ajax()) {

            $product_id = $request->product_id;

            $color_id = $request->color_id;

            $activeSize = $request->activeSize;

            $output = "";



            $attribute_product = DB::table('attribute_product')

                ->join('attributes', 'attribute_product.attribute_id', 'attributes.id')

                ->where('product_id', $product_id)

                ->where('color_id', $color_id)

                ->groupBy('attribute_id')

                ->get();

//            $numbderofSize = count($customers);

            $attribute_legnth = '';

            $attribute_front = '';

            $attribute_back = '';

            $attribute_chest = '';

            if ($attribute_product) {

                foreach ($attribute_product as $sKey => $size) {



                    $checked = "";

                    $activeClass = '';

                    if ($activeSize == $size->attribute_id) {

                        $activeClass = 'size_active';

                        $checked = "checked";

                        $image = $size->attribute_image;

                        $activeSize = $size->attribute_id;

                        $product_price = $size->attribute_price;

                        if (!empty($size->attribute_legnth)) {

                            $attribute_legnth = 'Legnth: ' . $size->attribute_legnth;

                        }

                        if (!empty($size->attribute_front)) {

                            $attribute_front = ', Front: ' . $size->attribute_front;

                        }

                        if (!empty($size->attribute_back)) {

                            $attribute_back = ', Back: ' . $size->attribute_back;

                        }

                        if (!empty($size->attribute_chest)) {

                            $attribute_chest = ', Chest: ' . $size->attribute_chest;

                        }

                    }

//                        $activeClass = '';

                    if (empty($activeSize) && $sKey == 0) {



                        $activeClass = 'size_active';

                        $checked = "checked";

                        $image = $size->attribute_image;

                        $activeSize = $size->attribute_id;

                        $product_price = $size->attribute_price;

                        if (!empty($size->attribute_legnth)) {

                            $attribute_legnth = 'Legnth: ' . $size->attribute_legnth;

                        }

                        if (!empty($size->attribute_front)) {

                            $attribute_front = ', Front: ' . $size->attribute_front;

                        }

                        if (!empty($size->attribute_back)) {

                            $attribute_back = ', Back: ' . $size->attribute_back;

                        }

                        if (!empty($size->attribute_chest)) {

                            $attribute_chest = ', Chest: ' . $size->attribute_chest;

                        }

                    }

//                   

                    $output .= '<label for="size_' . $sKey . '" class="click_size">

                    <div class="check-box_inr_size">

                        <div class="size ' . $activeClass . '">

                            <span class="value"><b>' . $size->title . '</b></span>

                            <input ' . $checked . ' data-sizename="' . $size->title . '" data-price="' . $size->attribute_price . '"

                                   data-size_id="' . $size->attribute_id . '" data-product_id="' . $product_id . '"

                                     class="click_size hidden" id="size_' . $sKey . '"

                                   name="product_attribute_size" type="radio" value="' . $size->attribute_id . '">

                        </div>

                    </div>

                </label>

                     ';

                }

//                var_dump($attribute_legnth);

//                exit;

                if (!empty($image)) {

                    $image_path = pathinfo($image);

                    $final_imagename = $image_path['filename'];

                    $final_extension = $image_path['extension'];

                    $data['attribute_image'] = '<img id="product-zoom" src="' . url('/storage/uploads/' . $final_imagename . '_472x575.' . $final_extension) . '" data-zoom-image="' . url('/storage/uploads/' . $final_imagename . '_1000x1500.' . $final_extension) . '" class="image-style" alt="Product-11">';

                } else {

                    $final_imagename = '';

                    $final_extension = '';

                    $data['attribute_image'] = '';

                }





                $data['attribute_measurement'] = $attribute_legnth . $attribute_front . $attribute_back . $attribute_chest;

                $data['product_price'] = SM::currency_price_value($product_price);

                $data['attribute_label'] = $output;

                return Response()->json($data);

//                return Response($output);

            } else {

                return Response()->json(['no' => 'Not found']);

            }

        }

    }



    public function product_size_by_color(Request $request)

    {

        if ($request->ajax()) {

            $product_id = $request->product_id;

            $size_id = $request->size_id;

            $activeColor = $request->activeColor;

            $output = "";

            $customers = DB::table('attribute_product')

                ->join('attributes', 'attribute_product.color_id', 'attributes.id')

                ->where('product_id', $product_id)

                ->where('attribute_id', $size_id)

                ->groupBy('color_id')

                ->get();

            $attribute_legnth = '';

            $attribute_front = '';

            $attribute_back = '';

            $attribute_chest = '';



            if ($customers) {

                foreach ($customers as $cKey => $color) {

                    $activeClass = '';

                    $checked = "";

                    if ($activeColor == $color->color_id) {

                        $activeClass = 'color_active';

                        $checked = "checked";

                        $image = $color->attribute_image;

                        if (!empty($color->attribute_legnth)) {

                            $attribute_legnth = 'Legnth: ' . $color->attribute_legnth;

                        }

                        if (!empty($color->attribute_front)) {

                            $attribute_front = ', Front: ' . $color->attribute_front;

                        }

                        if (!empty($color->attribute_back)) {

                            $attribute_back = ', Back: ' . $color->attribute_back;

                        }

                        if (!empty($color->attribute_chest)) {

                            $attribute_chest = ', Chest: ' . $color->attribute_chest;

                        }

                    }

                    $product_price = $color->attribute_price;

                    $output .= '<label for="color_' . $cKey . '" class="click_color">

                    <div class="check-box_inr_color">

                        <div class="color ' . $activeClass . '">

                            <span class="value"><b>' . $color->title . '</b></span>

                            <input ' . $checked . ' data-price="' . $color->attribute_price . '" data-product_id="' . $product_id . '"

                                   data-color_id="' . $color->color_id . '" data-colorname="' . $color->title . '"

                                   value="' . $color->color_id . '"  class="click_color hidden" id="color_' . $cKey . '"

                                    name="product_attribute_color" type="radio">

                        </div>

                    </div>

                </label> 

                ';

                }



                if (!empty($image)) {

                    $image_path = pathinfo($image);

                    $final_imagename = $image_path['filename'];

                    $final_extension = $image_path['extension'];

                    $data['attribute_image'] = '<img id="product-zoom" src="' . url('/storage/uploads/' . $final_imagename . '_472x575.' . $final_extension) . '" data-zoom-image="' . url('/storage/uploads/' . $final_imagename . '_1000x1500.' . $final_extension) . '" class="image-style" alt="Product-11">';

                } else {

                    $final_imagename = '';

                    $final_extension = '';

                    $data['attribute_image'] = '';

                }

                $data['attribute_measurement'] = $attribute_legnth . $attribute_front . $attribute_back . $attribute_chest;

                $data['attribute_label'] = $output;

                $data['product_price'] = SM::currency_price_value($product_price);

                return Response()->json($data);

            } else {

                return Response()->json(['no' => 'Not found']);

            }

        }

    }



    public function categoryByProduct($slug)

    {

        $data["categoryInfo"] = SM::getCache('category_' . $slug, function () use ($slug) {

            return Category::with("products")

                ->where("slug", $slug)

                ->where('status', 1)

                ->first();

        });

        if (!empty($data["categoryInfo"])) {

            $page = \request()->input('page', 0);

            $key = 'categoryProducts_' . $data["categoryInfo"]->id . '_' . $page;

            $data["products"] = SM::getCache(

                $key, function () use ($data) {

                $product_posts_per_page = SM::smGetThemeOption(

                    "shop_page_per_product", config("constant.smFrontPagination")

                );

                return $data["categoryInfo"]->products()

                    ->where("status", 1)

                    ->paginate($product_posts_per_page);

            }, ['categoryProducts']

            );



            $data['seo_title'] = $data['categoryInfo']->seo_title;

            $data["meta_key"] = $data["categoryInfo"]->meta_key;

            $data["meta_description"] = $data["categoryInfo"]->meta_description;

            $data["image"] = $data["categoryInfo"]->image != '' ? asset(SM::sm_get_the_src($data["categoryInfo"]->image, 750, 560)) : '';

            $data["category"] = Category::where('slug', $slug)->first();

            return view('frontend.products.category_by_product', $data);

        } else {

            return abort(404);

        }

    }



    public function authorByProduct($slug)

    {

        $data["authorInfo"] = SM::getCache('author_' . $slug, function () use ($slug) {

            return Author::with("products")

                ->where("slug", $slug)

                ->where('status', 1)

                ->first();

        });
        
        

        if (!empty($data["authorInfo"])) {

            $page = \request()->input('page', 0);

            $key = 'authorProducts_' . $data["authorInfo"]->id . '_' . $page;

            $data["products"] = SM::getCache(

                $key, function () use ($data) {

                $product_posts_per_page = SM::smGetThemeOption(

                    "shop_page_per_product", config("constant.smFrontPagination")

                );
                $id = $data["authorInfo"]->id;
                $author_id = array();
                $author_id[0] = $id;

                return $data["authorInfo"]->products()

                    ->where("status", 1)
                    // ->whereRaw('json_contains(products.author_id, \'["'.$data["authorInfo"]->id.'"]\')')
                    ->whereIn("author_id", $author_id)

                    ->paginate($product_posts_per_page);

            }, ['authorProducts']

            );



            $data['seo_title'] = $data['authorInfo']->seo_title;

            $data["meta_key"] = $data["authorInfo"]->meta_key;

            $data["meta_description"] = $data["authorInfo"]->meta_description;

            $data["image"] = $data["authorInfo"]->image != '' ? asset(SM::sm_get_the_src($data["authorInfo"]->image, 750, 560)) : '';

            $data["author"] = Author::where('slug', $slug)->first();

            return view('frontend.products.author_by_product', $data);

        } else {

            return abort(404);

        }

    }



    public function publisherByProduct($slug)

    {

        $data["publisherInfo"] = SM::getCache('publisher_' . $slug, function () use ($slug) {

            return Publisher::with("products")

                ->where("slug", $slug)

                ->where('status', 1)

                ->first();

        });

        if (!empty($data["publisherInfo"])) {

            $page = \request()->input('page', 0);

            $key = 'publisherProducts_' . $data["publisherInfo"]->id . '_' . $page;

            $data["products"] = SM::getCache(

                $key, function () use ($data) {

                $product_posts_per_page = SM::smGetThemeOption(

                    "shop_page_per_product", config("constant.smFrontPagination")

                );

                return $data["publisherInfo"]->products()

                    ->where("status", 1)

                    ->paginate($product_posts_per_page);

            }, ['publisherProducts']

            );



            $data['seo_title'] = $data['publisherInfo']->seo_title;

            $data["meta_key"] = $data["publisherInfo"]->meta_key;

            $data["meta_description"] = $data["publisherInfo"]->meta_description;

            $data["image"] = $data["publisherInfo"]->image != '' ? asset(SM::sm_get_the_src($data["publisherInfo"]->image, 750, 560)) : '';

            $data["publisher"] = Publisher::where('slug', $slug)->first();

            return view('frontend.products.publisher_by_product', $data);

        } else {

            return abort(404);

        }

    }



    public function tagByProduct($slug)

    {

        $data["tagInfo"] = SM::getCache('tag_' . $slug, function () use ($slug) {

            return Tag::with("products")

                ->where("slug", $slug)

                ->where('status', 1)

                ->first();

        });

        if (count($data["tagInfo"]) > 0) {

            $page = \request()->input('page', 0);

            $key = 'tagProducts_' . $data["tagInfo"]->id . '_' . $page;

            $data["products"] = SM::getCache($key, function () use ($data) {



                $blog_posts_per_page = SM::smGetThemeOption(

                    "shop_page_per_product", config("constant.smFrontPagination")

                );



                return $data["tagInfo"]->products()

                    ->where("status", 1)

                    ->paginate($blog_posts_per_page);

            }, ['tagProducts']);

            $data['key'] = $key;

            $data['seo_title'] = $data['tagInfo']->seo_title;

            $data["meta_key"] = $data["tagInfo"]->meta_key;

            $data["meta_description"] = $data["tagInfo"]->meta_description;

            return view('frontend.products.tag_by_product', $data);

        } else {

            return abort(404);

        }

    }



    public function brandByProduct($slug)

    {

        $data["brandInfo"] = SM::getCache('brand_' . $slug, function () use ($slug) {

            return Brand::with("products")

                ->where("slug", $slug)

                ->where('status', 1)

                ->first();

        });

        if (count($data["brandInfo"]) > 0) {

            $page = \request()->input('page', 0);

            $key = 'brandProducts_' . $data["brandInfo"]->id . '_' . $page;

            $data["products"] = SM::getCache($key, function () use ($data) {



                $blog_posts_per_page = SM::smGetThemeOption(

                    "shop_page_per_product", config("constant.smFrontPagination")

                );

                return $data["brandInfo"]->products()

                    ->where("status", 1)

                    ->paginate($blog_posts_per_page);

            }, ['brandProducts']);

            $data['key'] = $key;

            $data['seo_title'] = $data['brandInfo']->seo_title;

            $data["meta_key"] = $data["brandInfo"]->meta_key;

            $data["meta_description"] = $data["brandInfo"]->meta_description;

            return view('frontend.products.brand_by_product', $data);

        } else {

            return abort(404);

        }

    }



    public function shopDetails()

    {

        return view('frontend.page.shopDetails');

    }





}

