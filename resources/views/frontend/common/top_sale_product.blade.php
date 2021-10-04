<?php $bestSaleProducts = SM::getBestSaleProduct();



?>

@if(count($bestSaleProducts)>0)

    <section class="site-content">

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

                                <div class="overlay" style="display:none;"><img

                                            src="{{asset('/frontend')}}/images/loader.gif"></div>

                                <div id="special" role="tabpanel" aria-labelledby="special-tab">

                                    <div id="owl_special" class="owl-carousel owl-loaded owl-drag">

                                        <div class="owl-stage-outer">

                                            <div class="owl-stage">

                                                @if(count($bestSaleProducts)>0)

                                                    @forelse($bestSaleProducts as $key=>$best_sale)



                                                        @if($best_sale->product_type==2)

                                                            <div class="owl-item active">

                                                                <div class="product">

                                                                    <div class="product-grid">

                                                                        <div class="product-image">

                                                                            <a href="{{url('/product/'.$best_sale->slug)}}"

                                                                               class="image">



                                                                                <img class="pic-1"

                                                                                     src="{!! SM::sm_get_the_src($best_sale->image, 200,200) !!}"

                                                                                     alt="{{$best_sale->title}}">

                                                                                <img class="pic-2"

                                                                                     src="{!! SM::sm_get_the_src($best_sale->image, 200,200) !!}"

                                                                                     alt="{{$best_sale->title}}">



                                                                            </a>



                                                                            <p class="custom-off-amount">{{SM::productDiscount($best_sale->id )}}

                                                                                %</p>

                                                                        </div>

                                                                        <div class="product-content">

                                                                            <h3 class="title"><a

                                                                                        href="{{url('/product/'.$best_sale->slug)}}">{{$best_sale->title}}</a>

                                                                            </h3>

                                                                            <h6 class="product-category">{{$best_sale->title}}</h6>

                                                                            <a data-add_class="btn-add-cart"

                                                                               data-product_id="{{ $best_sale->id }}"

                                                                               data-regular_price="{{ $best_sale->regular_price }}"

                                                                               data-sale_price="{{ $best_sale->sale_price }}"

                                                                               class="addToCart  add-to-cart-ex"><i

                                                                                        class="fa fa-shopping-cart cart-ad-custom">

                                                                                    Cart </i> </a>



                                                                            <div class="price">

                                                                                <span>৳{{$best_sale->regular_price}}</span>৳{{$best_sale->sale_price}}

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

                                                            <div class="owl-item active"

                                                                 style="width: 268px; margin-right: 10px;">

                                                                <div class="product">

                                                                    <div class="product-grid">

                                                                        <div class="product-image">

                                                                            <a href="{{url('/product/'.$best_sale->slug)}}"

                                                                               class="image">



                                                                                <img class="pic-1"

                                                                                     src="{!! SM::sm_get_the_src($best_sale->image, 200,200) !!}"

                                                                                     alt="{{$best_sale->title}}">

                                                                                <img class="pic-2"

                                                                                     src="{!! SM::sm_get_the_src($best_sale->image, 200,200) !!}"

                                                                                     alt="{{$best_sale->title}}">



                                                                            </a>

                                                                            @if (!empty($product->sale_price > 0))

                                                                                <p class="custom-off-amount">{{SM::productDiscount($best_sale->id )}}

                                                                                    %</p>

                                                                            @endif



                                                                        </div>

                                                                        <div class="product-content">

                                                                            <h3 class="title"><a

                                                                                        href="{{url('/product/'.$best_sale->slug)}}">{{$best_sale->title}}</a>

                                                                            </h3>

                                                                            <h6 class="text-center wait-st-unit">{{$best_sale->product_weight}} {{SM::product_wait_unit($best_sale->unit_id)->title}}</h6>

                                                                            @if($best_sale->sale_price > 0)

                                                                                <p class="price">

                                                                                    <span>{{ SM::currency_price_value($best_sale->regular_price) }}</span>{{ SM::currency_price_value($best_sale->sale_price) }}

                                                                                </p>

                                                                            @else

                                                                                <p class="price">{{ SM::currency_price_value($best_sale->regular_price) }}</p>

                                                                            @endif



                                                                            <ul class="social">

                                                                                <li class="custom-heart-extra">

                                                                                    <?php  echo SM::addToCartButton($best_sale->id, $best_sale->regular_price, $best_sale->sale_price) ?>

                                                                                </li>

                                                                            </ul>

                                                                        </div>

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



