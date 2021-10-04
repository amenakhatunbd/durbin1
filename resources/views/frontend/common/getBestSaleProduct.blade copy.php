@if(count($products)>0)
    <section class="recent-sold-section wow fadeInLeft">
        <div class="container">
            <div class="{{ $class }}">
                <div class="title-header">
                    <h3>{{ $title }}</h3>
                    @if(!empty($view_all))
                        <a href="{{url($view_all_link)}}"
                            class="pull-right btn btn-default button-view-all"> <i class="fa fa-eye"></i> {{ $view_all }}
                        </a>
                    @endif
                </div>
                <div class="recent-sold-slide all-caro-btn">
                    @foreach($products as $key=> $product)
                        <div class="col-md-2 col-sm-4 pad-no">
                            <div class="panel-book-box wow fadeInUp" data-wow-duration="2s" data-wow-delay="1s">
                                <a href="{{ url('book/'.$product->slug) }}">
                                    <img src="{{ SM::sm_get_the_src($product->image, 130, 186) }}">
                                    @if($product->sale_price>0)
                                        <div class="discount-badge">
                                            <p>{{ SM::productDiscount($product->id) }}% <small style="display: block">Off</small> </p>
                                        </div>
                                    @endif
                                    <div class="book-text-area">
                                        <p class="book-title">{{ $product->title }}</p>
                                        @if(!empty($product->author_id))
                                            <p class="book-author">
                                                <?php
                                                    $list = explode(",", $product->author_id);
                                                    $count = sizeof($list)-1;
                                                    foreach($list as $key => $author)
                                                    {
                                                        $auhtor_info = DB::table('authors')->where('id', $author)->first();
                                                        // dd($auhtor_info->slug);
                                                        ?>
                                                        @if($key == $count)
                                                        <a target="_blank" href="{{ url('/author',$auhtor_info->slug) }}">{{ $auhtor_info->title }}</a>
                                                        @else
                                                        <a target="_blank" href="{{ url('/author',$auhtor_info->slug) }}">{{ $auhtor_info->title }}, </a>
                                                        @endif
                                                    <?php }
                                                ?>
                                            </p>
                                        @endif
                                        <p class="book-status text-capitalize text-center">Product in stock</p>
                                        <p class="book-price">
                                            @if($product->sale_price>0)
                                                <strike class="original-price">{{ SM::currency_price_value($product->regular_price) }} </strike>
                                                {{ SM::currency_price_value($product->sale_price) }}
                                            @else
                                                {{ SM::currency_price_value($product->regular_price) }}
                                            @endif
                                        </p>
                                        <div class="mobile-btn-custom">
                                            <a data-product_id="{{ $product->id }}" class="addToCart btn btn-warning button-absotalate">Add to cart</a>
                                        </div>
                                    </div>
                                </a>
                                <div class="book-details-overlay" onclick="window.location='{{ url('book/'.$product->slug) }}'">
                                    <!--<?php echo SM::addToCartButton($product->id, $product->regular_price, $product->sale_price); ?>-->
                                    <a href="{{ url('book/'.$product->slug) }}"
                                       class="btn btn-info btn-block button-fixed">View Details</a>
                                </div>
                                <div class="overlay-btn">
                                    <a data-product_id="{{ $product->id }}" class="addToCart btn btn-warning button-absotalate">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
