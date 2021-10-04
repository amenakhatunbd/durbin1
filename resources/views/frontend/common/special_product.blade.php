<?php $special_product = SM::getSpecialProduct();
?>
@if(count($special_product)>0)
    <section class="site-content">
        <div class="container-fluid">
            <div class="products-area">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-spacial p-0">
                        <div class="paanel custom-panel-style">
                            <div class="panel-heading">
                                <h2 class="custom-panel-heading">Special Product</h2>
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
                                                @if(count($special_product)>0)
                                                    @forelse($special_product as $key=>$special_p)

                                                        @if($special_p->product_type==2)
                                                            <div class="owl-item active">
                                                                <div class="product">
                                                                    <div class="product-grid">
                                                                        <div class="product-image">
                                                                            <a href="{{url('/frontend/product'.$special_p->slug)}}"
                                                                               class="image">

                                                                                <img class="pic-1"
                                                                                     src="{!! SM::sm_get_the_src($special_p->image, 200,200) !!}"
                                                                                     alt="{{$special_p->title}}">
                                                                                <img class="pic-2"
                                                                                     src="{!! SM::sm_get_the_src($special_p->image, 200,200) !!}"
                                                                                     alt="{{$special_p->title}}">

                                                                            </a>

                                                                            <p class="custom-off-amount">{{SM::productDiscount($special_p->id )}}
                                                                                %</p>
                                                                        </div>
                                                                        <div class="product-content">
                                                                            <h3 class="title"><a
                                                                                        href="Special Product ">{{$special_p->title}}</a>
                                                                            </h3>
                                                                            <h6 class="product-category">{{$special_p->title}}</h6>
                                                                            <a data-add_class="btn-add-cart"
                                                                               data-product_id="{{ $special_p->id }}"
                                                                               data-regular_price="{{ $special_p->regular_price }}"
                                                                               data-sale_price="{{ $special_p->sale_price }}"
                                                                               class="addToCart  add-to-cart-ex"><i
                                                                                        class="fa fa-shopping-cart cart-ad-custom">
                                                                                    Cart </i> </a>

                                                                            <div class="price">
                                                                                <span>৳{{$special_p->regular_price}}</span>৳{{$special_p->sale_price}}
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
                                                                            <a href="{{url('/product/'.$special_p->slug)}}"
                                                                               class="image">

                                                                                <img class="pic-1"
                                                                                     src="{!! SM::sm_get_the_src($special_p->image, 200,200) !!}"
                                                                                     alt="{{$special_p->title}}">
                                                                                <img class="pic-2"
                                                                                     src="{!! SM::sm_get_the_src($special_p->image, 200,200) !!}"
                                                                                     alt="{{$special_p->title}}">

                                                                            </a>

                                                                            <p class="custom-off-amount">{{SM::productDiscount($special_p->id )}}
                                                                                %</p>

                                                                        </div>
                                                                        <div class="product-content">
                                                                            <h3 class="title"><a
                                                                                        href="#">{{$special_p->title}}</a>
                                                                            </h3>
                                                                            <h6 class="text-center wait-st-unit">{{$special_p->product_weight}} {{SM::product_wait_unit($special_p->unit_id)->title}}</h6>
                                                                            @if($special_p->sale_price > 0)
                                                                                <p class="price">
                                                                                    <span>{{ SM::currency_price_value($special_p->regular_price) }}</span>{{ SM::currency_price_value($special_p->sale_price) }}
                                                                                </p>
                                                                            @else
                                                                                <p class="price">{{ SM::currency_price_value($special_p->regular_price) }}</p>
                                                                            @endif

                                                                            <ul class="social">
                                                                                <li class="custom-heart-extra">
                                                                                    <?php  echo SM::addToCartButton($special_p->id, $special_p->regular_price, $special_p->sale_price) ?>
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

