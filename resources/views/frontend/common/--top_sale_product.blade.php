<section class="site-content">
    <?php $special_product = SM::getBestSaleProduct();?>
    <div class="container-fluid">
        <div class="products-area">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-spacial p-0">
                    <div class="paanel custom-panel-style">
                        <div class="panel-heading">
                            <h2 class="custom-panel-heading">Top Selling Product</h2>
                            <hr class="heading-ex">
                        </div>
                        <div class="panel-body">
                            <!-- Tab panes -->
                            <div class="overlay" style="display:none;"><img src="{{asset('/frontend')}}/images/loader.gif"></div>
                            <div id="special" role="tabpanel" aria-labelledby="special-tab">
                                <div id="owl_special" class="owl-carousel owl-loaded owl-drag">
                                    <div class="owl-stage-outer">
                                        <div class="owl-stage" >
                                            @if(count($special_product)>0)
                                                @forelse($special_product as $key=>$product)

                                                    @if($product->product_type==2)
                                                       <div class="" >
                                                          <div class="product">
                                                            <div class="product-grid">
                                                                <div class="product-image">
                                                                    <a href="{{url('/frontend/product'.$product->slug)}}" class="image">

                                                                        <img class="pic-1" src="{!! SM::sm_get_the_src($product->image, 200,200) !!}" alt="{{$product->title}}">
                                                                        <img class="pic-2" src="{!! SM::sm_get_the_src($product->image, 200,200) !!}" alt="{{$product->title}}">

                                                                    </a>
                                                                    <?php $descount=$product->regular_price-$product->sale_price;
                                                                    $des=$descount/100;
                                                                    ?>
                                                                    <p class="custom-off-amount">{{$des}}%</p>
                                                                </div>
                                                                <div class="product-content">
                                                                    <h3 class="title"><a href="{{url('/product/'.$product->slug)}}">{{$product->title}}</a></h3>
                                                                    <h6 class="product-category">{{$product->title}}</h6>
                                                                    <a data-add_class="btn-add-cart" data-product_id="{{ $product->id }}"
                                                                       data-regular_price="{{ $product->regular_price }}"
                                                                       data-sale_price="{{ $product->sale_price }}"
                                                                       class="addToCart add-to-cart-ex"><i class="fa fa-shopping-cart cart-ad-custom"> Cart </i> </a>

                                                                    <div class="price"><span>৳{{$product->regular_price}}</span>৳{{$product->sale_price}}</div>
                                                                    <ul class="social">
                                                                        <li class="custom-heart-extra"><span products_id="80" class="fa  fa-heart-o  is_liked"></span></li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                        </div>
                                                       </div>
                                                    @else
                                                        <div class="owl-item active">
                                                            <div class="product1">
                                                                <div class="product-grid">
                                                                    <div class="product-image">
                                                                        <a href="{{url('/product/'.$product->slug)}}" class="image">
                                                                            <img class="pic-1" src="{!! SM::sm_get_the_src($product->image, 200,200) !!}" alt="{{$product->title}}">
                                                                            <img class="pic-2" src="{!! SM::sm_get_the_src($product->image, 200,200) !!}" alt="{{$product->title}}">
                                                                        </a>
                                                                        @if($product->sale_price > 0)
                                                                             <p class="custom-off-amount">{{SM::productDiscount($product->id )}}%</p>
                                                                        @endif
                                                                    </div>
                                                                    <div class="product-content">
                                                                        <h3 class="title"><a href="{{url('/product/'.$product->slug)}}">{{$product->title}}</a></h3>
                                                                        <h6 class="text-center wait-st-unit"><span>{{$product->product_weight}}</span> {{SM::product_wait_unit($product->unit_id)->title}}</h6>
                                                                        @if($product->sale_price > 0)
                                                                        <p class="price"><span>{{ SM::currency_price_value($product->regular_price) }}</span>{{ SM::currency_price_value($product->sale_price) }}</p>
                                                                        @else
                                                                        <p class="price">{{ SM::currency_price_value($product->regular_price) }}</p>
                                                                        @endif

                                                                        <ul class="social">
                                                                            <li class="custom-heart-extra">
                                                                                <?php  echo SM::addToCartButton($product->id, $product->regular_price, $product->sale_price) ?>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endif
                                                @empty
                                                    <label class="label label-warning">Special Product Not Found...!</label>
                                                @endforelse
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


