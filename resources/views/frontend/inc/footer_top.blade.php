<style>

    .thumb img {
        background-size: cover;
        background-position: center;
        transition: all 0.7s ease;
    }

    .thumb img:hover {
        transform: scale(1.5);
    }

    #ShowDivButton img {
        height: 22px;
        text-align: center;
    }
    .ShowDivButton {
        position: absolute;
        right: 16%;
        top: 56%;
        overflow: hidden;
    }
</style>
<section class="banner-content">
    <button class="bttn-cart showButton cart_icon_popup ShowDivButton" id="ShowDivButton">
        <img src="{{url('/frontend/images/cart_white.png')}}">
        <p>{{ Cart::instance('cart')->count() }} Item(s)</p>
        <p><span>{{ SM::currency_price_value(Cart::instance('cart')->subTotal()) }}</span></p>
    </button>

    <div id="aitcg-control-panel" style="display: none">
        <button class="bttn-close hideButton" id="ShowDivButton">
            <i class="fa fa-times"></i> Close
        </button>
        <h1 class="popup_top_total"><i class="fa fa-shopping-bag"></i> {{ Cart::instance('cart')->count() }} ITEMS</h1>
        <h4>Trusted Online Shopping Site</h4>
        <div class="add-product-area header_cart_html" style="max-height: 500px; overflow-y: inherit">
            <?php $items = Cart::instance('cart')->content(); ?>
            @forelse($items as $id=>$item)
                <div class="add-pro-liner">
                    <div class="counting">
                        <i class="fa fa-plus inc" data-row_id="{{ $item->rowId }}" style="color: green;"></i>
                        <input type="hidden" name="qty" class="form-control input-sm qty-inc-dc"
                               id="{{ $item->rowId }}" value="{{ $item->qty }}">
                        <h3 class="itemqty"><span>{{$item->qty}}</span></h3>
                        <i class="fa fa-minus dec" data-row_id="{{ $item->rowId }}" style="color: green;"></i>
                    </div>

                    <img src="{{ SM::sm_get_the_src($item->options->image, 100, 122) }}" alt="{{$item->name}}">
                    <div class="pro-head">
                        <h3>{{$item->name}}</h3>
                        <h3 class="ammount">{{SM::currency_price_value($item->price)}}</h3>
                    </div>

                    <span class="pro-close removeToCart" data-product_id="{{$id}}"
                          onclick="delete_cart_product($id)"><i class="fa fa-times-circle"></i></span>
                </div>
                <hr>
            @empty
                <div class="empty_img image-emty">
                    <img class="image-emty-busket" src="{{asset('/frontend')}}/images/busketempty.png">
                </div>
                <div class="text-center">
                    <span>Empty Cart</span>
                </div>
            @endforelse
        </div>

        <div class="add-btn-area">
            <h5 class="sub_total">{{ SM::currency_price_value(Cart::instance('cart')->subTotal()) }}</h5>
            <!--<a class="btn btn-add-place" data-toggle="modal" data-target="#myLogin" href="">Place Order</a>-->
            <a class="btn btn-add-place" href="{{URL('cart')}}">Place Order</a>
        </div>

        <div class="text-center">
            <a class="btn btn-info view-cart-btn-ex" href="{{url('/cart')}}">View Cart</a>
        </div>
    </div>
    <?php
    $services = SM::smGetThemeOption("services", array());
    ?>
    @if(count($services)>0)
        <div class="container">
            <div class="col-md-12">
                <div class="row">
                    @foreach($services as $key=> $service)
                        <?php
                        $title = isset($service["title"]) ? $service["title"] : "";
                        $description = isset($service["description"]) ? $service["description"] : "";
                        $icon = isset($service["icon"]) ? $service["icon"] : "";
                        $class = ($key !== count($services) - 1) ? "" : " last";
                        ?>
                        <div class="col-12 col-md-3 p-0">
                            <div class="banner-single{{ $class }}">
                                <div class="panel">
                                    @empty(!$title)
                                        <h3 class="{{ $icon }}"></h3>
                                        <div class="block">
                                            <h4 class="title">{{ $title }}</h4>
                                            
                                        </div>
                                    @endempty
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    @endif
</section>





