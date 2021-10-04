<?php
$site_name = SM::sm_get_site_name();
$site_name = SM::sm_string($site_name) ? $site_name : 'buckleup-bd';
$mobile = SM::get_setting_value('mobile');
$email = SM::get_setting_value('email');
$address = SM::get_setting_value('address');
$footer_logo = SM::smGetThemeOption("footer_logo", "");
$footer_widget2_title = SM::smGetThemeOption('footer_widget2_title', "Seo Services");
$footer_widget2_description = SM::smGetThemeOption('footer_widget2_description', "");
$footer_widget3_title = SM::smGetThemeOption('footer_widget3_title', "Company");
$footer_widget3_description = SM::smGetThemeOption('footer_widget3_description', "");
$footer_widget4_title = SM::smGetThemeOption('footer_widget4_title', "Technology");
$footer_widget4_description = SM::smGetThemeOption('footer_widget4_description', "");
$contact_branches = SM::smGetThemeOption("contact_branches");
$newsletter_success_title = SM::smGetThemeOption("newsletter_success_title", "Thank You For Subscribing!");
$newsletter_success_description = SM::smGetThemeOption("newsletter_success_description", "You're just one step away from being one of our dear susbcribers.Please check the Email provided and confirm your susbcription.");
$payment_method_image = SM::smGetThemeOption("payment_method_image", "");
?>

<style>

    .thumb img {
        background-size: cover;
        background-position: center;
        transition: all 0.7s ease;
    }

    .thumb img:hover {
        transform: scale(1.5);
    }
</style>


{{--Cart popup----}}
<section class="banner-content">
    <button class="bttn-cart showButton cart_icon_popup" id="ShowDivButton">
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
        <div class="add-product-area header_cart_html" style="max-height: 500px; overflow-y: auto">
            <div class="add-product-area">
                <?php
                $items = Cart::instance('cart')->content();

                ?>
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

    <style>
        .image-emty {
            height: 200px;
            width: 200px;
            padding: 33px;
            border-radius: 200px;
        }

        .image-emty-busket {
            height: 230px;
            width: 230px;
            background: #ededed;
            padding: 60px;
            border-radius: 200px;
        }

        .itemqty {
            border: 1px solid #ededed;
            text-align: center;
            margin-bottom: 3px;
            margin-top: 6px;
        }

        .decrementQty {
            color: green;
            text-align: center;
            padding: 0px 5px;
        }

        .incrementQty {
            color: green;
            text-align: center;
            padding: 0px 5px;
        }

        /*h3 span {*/
        /*font-size: 14px;*/
        /*margin: 20px 0px;*/
        /*}*/
        .add-pro-liner {
            height: 65px;
        }

        .bttn-cart {
            color: white;
            cursor: pointer;
            position: fixed;
            right: -13px;
            top: 45%;
            z-index: 9999;
            overflow: hidden;
            border: 0;
            border-right: 0;
            height: 85px;
            border-radius: 6px 0px 0px 6px;
            background: #B90F37;
            width: 85px;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .bttn-cart p {
            color: #FEF7F8;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.3px;
            background: transparent;
            margin-bottom: 0;
            /*padding: 0px 11px;*/
        }

        .bttn-cart h5 span {
            font-size: 10px;
        }

        #aitcg-control-panel {
            display: block;
            position: fixed;
            z-index: 999999;
            bottom: 0;
            left: auto;
            right: 0 !important;
            top: 100px;
            background-color: #fff;
            border-radius: 0;
            width: auto;
            margin-left: 0;
            width: 294px;
            -webkit-box-shadow: -1px 0px 15px 0px rgba(0, 0, 0, 0.55);
            -moz-box-shadow: -1px 0px 15px 0px rgba(0, 0, 0, 0.55);
            box-shadow: -1px 0px 15px 0px rgba(0, 0, 0, 0.55);
        }

        #aitcg-control-panel h1 {
            font-size: 14px;
            font-weight: 900;
            font-style: italic;
            color: #fff;
            background: #497806;
            padding: 10px;
            letter-spacing: 0.7px;
            text-transform: uppercase;
        }

        .bttn-close {
            position: absolute;
            right: 4px;
            margin: 6px 3px;
            padding: 3px 9px;
            background: #fcf7f7;
            color: #b71016;
            text-transform: uppercase;
            font-size: 13px;
            font-weight: 900;
            letter-spacing: 1px;
            border-radius: 50px;
        }

        .bttn-close:hover {
            background: #833737;
            color: #fff;
        }

        #aitcg-control-panel h4 {
            font-size: 12px;
            font-weight: 900;
            color: #fff;
            background: #E9AF0C;
            padding: 10px;
            letter-spacing: 0.7px;
            text-transform: uppercase;
            margin-top: -7px;
            margin-bottom: 0;
        }

        .add-btn-area {
            width: 100%;
            display: block;
            background: #fff;
            float: left;
            padding: 10px 20px;
            padding-bottom: 0px;
            position: absolute;
            bottom: 80px;
        }

        .view-cart-btn-ex {
            width: 100%;
            position: absolute;
            left: 0;
            bottom: 130px;
        }

        .add-btn-area h5 {
            background: #b71016;
            height: 37px;
            font-size: 15px;
            font-weight: 900;
            color: #fff;
            padding: 10px 0;
            width: 50%;
            float: left;
            border-radius: 3px 0 0 3px;
            text-align: center;
        }

        .add-btn-area .btn-add-place {
            color: #fff;
            float: right;
            width: 50%;
            background: #30AD23;
            border: 0;
            padding: 7px 10px;
            font-size: 15px;
            font-weight: 400;
            border-radius: 0 3px 3px 0;
            text-shadow: none;
            height: 37px;
        }

        .add-pro-liner .counting {
            background: #ededed;
            padding: 4px;
            display: block;
            float: left;
        }

        .add-pro-liner img {
            max-width: 100%;
            width: auto;
            margin: 0px 5px;
            height: 64px;
            border: 1px solid #ededed;
            float: left;
        }

        .add-pro-liner .pro-head h3 {
            font-size: 13px;
            font-weight: 600;
            /* font-style: italic; */
            width: 100px;
            float: left;
            color: #303031;
        }

        .add-product-area {
            padding-top: 5px;
            /*height: 500px;*/
            /*overflow-y: scroll;*/
        }

        .pro-close i {
            font-size: 20px;
            float: right;
            position: relative;
            color: #b71016;
            margin-right: 10px;
        }

        .logo-style-info {
            margin-bottom: 15px;
            height: 50px;
        }
    </style>
    <?php
    $services = SM::smGetThemeOption("services", array());
    ?>
    @if(count($services)>0)
        <div class="container">
            <div class="row">
                @foreach($services as $key=> $service)
                    <?php
                    $title = isset($service["title"]) ? $service["title"] : "";
                    $description = isset($service["description"]) ? $service["description"] : "";
                    $icon = isset($service["icon"]) ? $service["icon"] : "";
                    $class = ( $key !== count( $services ) -1 ) ? "" : " last";
                    ?>
                    <div class="col-12 col-md-3 p-0">
                        <div class="banner-single{{ $class }}">
                            <div class="panel">
                                @empty(!$title)
                                    <h3 class="{{ $icon }}"></h3>
                                    <div class="block">
                                        <h4 class="title">{{ $title }}</h4>
                                        <p>{{ $description }}</p>
                                    </div>
                                @endempty
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    @endif
</section>

<footer class="footer-content">
    <div class="container-fluid">
        <div class="row">


            <div class="col-12 col-md-3 col-lg-3">
                <div class="single-footer">
                    <a href="{{URL('/')}}" class="logo">
                        <img class="logo-style-info" alt="{{ SM::get_setting_value('site_name') }}"
                             src="{{ SM::sm_get_the_src(SM::sm_get_site_logo(), 294, 90) }}"/>
                    </a>
                    <h6>Contact info</h6>
                    <ul class="contact-list  pl-0 mb-0">
                        <li><i class="fa fa-map-marker"></i> {{ $address }}</li>
                        <li><i class="fa fa-phone"></i>{{ $mobile }}</li>
                        <li><i class="fa fa-envelope-open-o"></i>{{$email}}</li>

                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="footer-block">
                    <div class="single-footer">
                        <h5 class="widget-title">{{ $footer_widget2_title }}</h5>
                        <ul class="links-list  mb-0">
                            {!! stripslashes($footer_widget2_description) !!}
                        </ul>
                    </div>
                    <div class="single-footer">
                        <h5>{{ $footer_widget3_title }}</h5>
                        <ul class="links-list  mb-0">
                            {!! stripslashes($footer_widget3_description) !!}
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3 box-extra">
                <div class="single-footer">
                    {!! Form::open(["method"=>"post", "action"=>'Front\HomeController@subscribe', 'class'=>'form-inline form-subscribe', 'id'=>"newsletterForm"]) !!}
                    <div class="form-group">
                        <input name="email" required type="email" class="form-control"
                               placeholder="Enter Your E-mail Address" style="width: 300px;">
                        <button type="submit" value="Subscribe" id="newsletterFormSubmit"
                                class="btn btn-default"><i class="fa fa-paper-plane-o"></i>
                        </button>
                    </div>
                    {!! Form::close() !!}

                    <div class="socials">
                        <h5>Follow Us</h5>
                        <ul class="list">
                            @empty(!SM::smGetThemeOption("social_facebook"))
                                <li><a href="{{ SM::smGetThemeOption("social_facebook") }}">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                            @endempty
                            @empty(!SM::smGetThemeOption("social_twitter"))
                                <li><a href="{{ SM::smGetThemeOption("social_twitter") }}">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                            @endempty
                            @empty(!SM::smGetThemeOption("social_google_plus"))
                                <li><a href="{{ SM::smGetThemeOption("social_google_plus") }}">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                            @endempty
                            @empty(!SM::smGetThemeOption("social_linkedin"))
                                <li><a href="{{ SM::smGetThemeOption("social_linkedin") }}">
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                </li>
                            @endempty
                            @empty(!SM::smGetThemeOption("social_github"))
                                <li><a href="{{ SM::smGetThemeOption("social_github") }}">
                                        <i class="fa fa-github"></i>
                                    </a>
                                </li>
                            @endempty
                            @empty(!SM::smGetThemeOption("social_pinterest"))
                                <li><a href="{{ SM::smGetThemeOption("social_pinterest") }}">
                                        <i class="fa fa-pinterest-p"> </i>
                                    </a>
                                </li>
                            @endempty
                            @empty(!SM::smGetThemeOption("social_youtube"))
                                <li><a href="{{ SM::smGetThemeOption("social_youtube") }}">
                                        <i class="fa fa-youtube-play"></i>
                                    </a>
                                </li>
                            @endempty
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</footer>

<div class="footer py-2 my-2" style="background: #394d38;color: #fff;">
    <div class="container-fluid">
        <div class="row">
            <div class="footer-image col-12 col-md-6">
                {{--<img src="{!! SM::sm_get_the_src($payment_method_image, 141, 18) !!}" alt="payment logo">--}}
            </div>
            <div class="footer-info col-12 col-md-6">
                <p class="text-center">{{ SM::smGetThemeOption("copyright") }}
                    <a style="color: #5cad5c;" target="_blank" href="http://nextpagetl.com/">Next Page Technology
                        Ltd.</a>
                </p>
            </div>
        </div>
    </div>
</div>

<!--notification-->
<div id="message_content"></div>



