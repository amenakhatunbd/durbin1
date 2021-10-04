<?php
$getBestSaleProduct = SM::getBestSaleProduct();
?>
@if(count($getBestSaleProduct)>0)
    <section class="site-content">
        <div class="container-fluid">
            <div class="products-area">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-spacial p-0">
                        <div class="paanel custom-panel-style">
                            <div class="panel-heading">
                                <h2 class="custom-panel-heading">Top Selling Product</h2>

                            </div>
                            <div class="panel-body">
                                <!-- Tab panes -->

                                <div class="overlay" style="display:none;"><img
                                            src="{{asset('/frontend')}}/images/loader.gif"></div>
                                <div id="special" role="tabpanel" aria-labelledby="special-tab">
                                    <div id="owl_special" class="owl-carousel owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage">
                                                @if(count($getBestSaleProduct)>0)
                                                    @forelse($getBestSaleProduct as $key=>$best_sales)

                                                        @if($best_sales->product_type==2)
                                                            <div class="owl-item active">
                                                                <div class="product">
                                                                    <div class="product-grid">
                                                                        <div class="product-image">
                                                                            <a href="{{url('/frontend/product'.$best_sales->slug)}}"
                                                                               class="image">

                                                                                <img class="pic-1"
                                                                                     src="{!! SM::sm_get_the_src($best_sales->image, 200,200) !!}"
                                                                                     alt="{{$best_sales->title}}">
                                                                                <img class="pic-2"
                                                                                     src="{!! SM::sm_get_the_src($best_sales->image, 200,200) !!}"
                                                                                     alt="{{$best_sales->title}}">

                                                                            </a>
                                                                            <?php $descount = $best_sales->regular_price - $best_sales->sale_price;
                                                                            $des = $descount / 100;
                                                                            ?>
                                                                            <p class="custom-off-amount">{{$des}}%</p>
                                                                        </div>
                                                                        <div class="product-content">
                                                                            <h3 class="title"><a
                                                                                        href="Special Product ">{{$best_sales->title}}</a>
                                                                            </h3>
                                                                            <h6 class="product-category">{{$best_sales->title}}</h6>
                                                                            <a data-add_class="btn-add-cart"
                                                                               data-product_id="{{ $best_sales->id }}"
                                                                               data-regular_price="{{ $best_sales->regular_price }}"
                                                                               data-sale_price="{{ $best_sales->sale_price }}"
                                                                               class="addToCart  add-to-cart-ex"><i
                                                                                        class="fa fa-shopping-cart cart-ad-custom">
                                                                                    Cart </i> </a>

                                                                            <div class="price">
                                                                                <span>৳{{$best_sales->regular_price}}</span>৳{{$best_sales->sale_price}}
                                                                            </div>
                                                                            <ul class="social">
                                                                                <li class="custom-heart-extra"><span
                                                                                            products_id="80"
                                                                                            class="fa  fa-heart-o  is_liked"></span>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="col-12 col-sm-4 col-md-3">
                                                                <div class="product-grid">
                                                                    <div class="product-image">
                                                                        <a href="{{url('/product/'.$best_sales->slug)}}"
                                                                           class="image">

                                                                            <img class="pic-1"
                                                                                 src="{!! SM::sm_get_the_src($best_sales->image, 200,200) !!}"
                                                                                 alt="{{$best_sales->title}}">
                                                                            <img class="pic-2"
                                                                                 src="{!! SM::sm_get_the_src($best_sales->image, 200,200) !!}"
                                                                                 alt="{{$best_sales->title}}">

                                                                        </a>
                                                                        @if($best_sales->sale_price > 0)
                                                                            <p class="custom-off-amount">{{SM::productDiscount($best_sales->id )}}
                                                                                %</p>
                                                                        @endif
                                                                    </div>
                                                                    <div class="product-content">
                                                                        <h3 class="title"><a
                                                                                    href="#">{{$best_sales->title}}</a>
                                                                        </h3>
                                                                        <h6 class="text-center wait-st-unit">{{$best_sales->product_weight}} {{SM::product_wait_unit($best_sales->unit_id)->title}}</h6>
                                                                        @if($best_sales->sale_price > 0)
                                                                            <p class="price">
                                                                                <span>{{ SM::currency_price_value($best_sales->regular_price) }}</span>{{ SM::currency_price_value($best_sales->sale_price) }}
                                                                            </p>
                                                                        @else
                                                                            <p class="price">{{ SM::currency_price_value($best_sales->regular_price) }}</p>
                                                                        @endif

                                                                        <ul class="social">
                                                                            <li class="custom-heart-extra">
                                                                                <?php  echo SM::addToCartButton($best_sales->id, $best_sales->regular_price, $best_sales->sale_price) ?>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        @endif
                                                    @empty
                                                        <label class="label label-warning">Special Product Not
                                                            Found...!</label>
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
@endif


