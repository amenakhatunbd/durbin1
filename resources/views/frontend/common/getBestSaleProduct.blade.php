@if(count($products)>0)
    <section class="recent-sold-section wow fadeInLeft">
        <div class="container">
            <div class="{{ $class }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title-header">
                            <h3>{{ $title }}</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="recent-sold-items">
                            <div class="owl-carousel owl-theme products_slider_active">
                                @foreach($products as $key=> $product)
                                    <div class="item">
                                        <div class="panel-book-box">
                                            <a href="{{ url('book/'.$product->slug) }}">
                                                <img src="{{ SM::sm_get_the_src($product->image, 130, 186) }}">
                                                @if($product->sale_price>0)
                                                    <div class="discount-badge">
                                                        <p>{{ SM::productDiscount($product->id) }}% <small style="display: block">Off</small> </p>
                                                    </div>
                                                @endif
                                                <div class="book-text-area">
                                                    <p class="book-title">{{ str_limit($product->title, 25) }}</p>
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
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="view_all_product_section_btn">
                                @if(!empty($view_all))
                                    <a href="{{url($view_all_link)}}"
                                        class="btn btn-default button-view-all">{{ $view_all }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        $(document).ready(function(){
            $('.products_slider_active').owlCarousel({
                loop:true,
                margin:10,
                nav:true,
                autoPlay: 1000,
                dots: false,
                responsive:{
                    0:{
                        items:2
                    },
                    600:{
                        items:2
                    },
                    1000:{
                        items:6
                    }
                }
            });
        });
    </script>

@endif
