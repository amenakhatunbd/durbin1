@if(count($relatedProduct) > 0)
    <div class="container-fluid">
        <div class="box-product-head-ez">
            <h4 class="box-title" style="margin-top: 25px;">Similar products</h4>
            <hr>
        </div>
        <div class="box-product-content">
            <div id="owl_releted" class="owl-carousel owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage"
                         style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 3058px;">
                        @foreach($relatedProduct as $key=>$rProductSingle)
                            <div class="owl-item">
                                <div class="product-grid  product-releted" style="background:#fff;">
                                    <div class="product-image">
                                        <a href="{{url('/product/'.$rProductSingle->slug)}}" class="image">
                                            <img class="img-responsive"
                                                 src="{!! SM::sm_get_the_src($rProductSingle->image, 200,200) !!}"
                                                 alt="{{$rProductSingle->title}}">

                                        </a>
                                        <?php
                                        if (!empty($rProductSingle->sale_price > 0)) {
                                            $descount = $rProductSingle->regular_price - $rProductSingle->sale_price;
                                            $des_count = $descount / 100;
                                            $des = '<p class="custom-off-amount">' . $des_count . '%</p>';
                                            echo $des;
                                        }
                                        ?>

                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"><a
                                                    href="{{url('/product/'.$rProductSingle->slug)}}">{{$rProductSingle->title}}</a>
                                        </h3>
                                        <h6 class="text-center wait-st-unit">{{$rProductSingle->product_weight}}{{SM::product_wait_unit($rProductSingle->unit_id)->title}}</h6>
                                        @if($rProductSingle->sale_price > 0)
                                            <p class="price">
                                                <span>{{SM::currency_price_value($rProductSingle->regular_price)}}</span>{{SM::currency_price_value($rProductSingle->sale_price)}}
                                            </p>
                                        @else
                                            <p class="price">{{SM::currency_price_value($rProductSingle->regular_price)}}</p>
                                        @endif

                                        <ul class="social">
                                            <li class="custom-heart-extra">
                                                <?php  echo SM::addToCartButton($rProductSingle->id, $rProductSingle->regular_price, $rProductSingle->sale_price) ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>

                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
@endif