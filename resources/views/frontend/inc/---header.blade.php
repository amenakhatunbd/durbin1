<div class="header-mini">
<div class="row container-fluid">
    <div class="navbar-brand">
        <a class=""><i class="fa fa-phone"></i> +880 1731823580</a> &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="mailto:sales@brandbychoice.com"><i class="fa fa-envelope"> </i> sales@mahmudmart.com.bd</a>
    </div>
    <div class="navbar-collapse" id="navbar_collapse_0">

        <ul class="nav-item navbar-top-right pull-right">
            @if(Auth::check())
                <li class="nav-item">
                    <div class="nav-link">
                        <span class="p-pic"><img src="{!! SM::sm_get_the_src(Auth::user()->image,30,30) !!}" alt="image">
                        </span>Welcome&nbsp;{{Auth::user()->username}}
                    </div>

                </li>
                <li class="nav-item"> <a href="{{ url('/dashboard') }}" class="nav-link -before"><i class="fa fa-home"> </i> Dashboard</a> </li>
                <li class="nav-item"> <a href="{{url('/logout')}}" class="nav-link -before"><i class="fa fa-power-off"> </i> Logout</a> </li>
            @else
                <li class="nav-link">Welcome Guest!</li>
                <li>
                    <a data-toggle="modal" data-target="#loginModal" class="btn btn-secondary btn-login-style" id="loginButton" xibkh="1">
                        Sign in
                    </a>
                </li>
                <li>
                    <a data-toggle="modal" data-target="#loginModal" class="btn btn-secondary btn-login-style"id="quickReg">
                        Register
                    </a>
                </li>
            @endif
        </ul>

    </div>

</div>
</div>

<input type="hidden" name="_token" id="table_csrf_token" value="{!! csrf_token() !!}">
<header id="header-area" class="header-area bg-primary">


    <div class="header-maxi custom-style-header">


        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-12  col-sm-12 col-md-3 spaceright-0 logo-paddin animatable bounceIn">

                    <a href="{{URL('/')}}" class="logo">
                        <img class="logo-style" alt="{{ SM::get_setting_value('site_name') }}" src="{{ SM::sm_get_the_src(SM::sm_get_site_logo(), 294, 90) }}"/>
                    </a>

                </div>

                <div class="col-12  col-sm-12 col-md-6">
                    <style>

                        ul#product-list {
                            position: absolute;
                            left: 27%;
                            top: 15%;
                            width: 611px;
                            background: #c7c7c7;
                        }
                        #myUL {
                            list-style-type: none;
                            padding: 0;
                            margin: 0;
                            position: absolute;
                            z-index: 1;
                            max-height: 420px;
                            overflow-y: scroll;
                            background: #fff;
                        }

                        ul#myUL li {
                            width: 100%;
                            background: #fff;
                            border-bottom: 1px solid #f0efef;
                            height: 48px;
                            float: left;
                        }

                        #myUL li a {
                            padding: 10px 5px;
                            display: block;
                            margin-top: -5px;
                            margin-left: -2px;
                        }

                        #myUL li:hover:not(.header) {

                            background-color: #eee;

                        }

                        .p-title {
                            float: left;
                            width: 72%;
                            padding: 5px;
                        }
                        .c-button .buttons {
                            height: 50px;
                        }
                        .p-image img {
                            height: 48px;
                            width: 55px;
                        }

                        .p-image {

                            float: left;

                        }

                        .c-button .btn.btn-block.btn-secondary.higlight-button {

                            display: contents;

                        }

                        button.btn.btn-secondary.btn-round.cart_search {

                            margin-top: 6px;

                        }

                        .c-button button.btn.btn-secondary.btn-round.cart_search.higlight-button {

                            background-color: #fff;

                            border-color: #fff;

                        }

                        .c-button a {

                            float: right;

                            height: 41px;

                            margin-right: 20px;

                            margin-top: 3px;

                        }


                        a.btn.btn-secondary.btn-round.higlight-button {
                            background: #fff;
                            position: relative;
                        }
                        .c-button{
                            padding: 8px;
                        }
                    </style>

                        {{--<input autocomplete="off" type="text" id="myInput" placeholder="Search for product information.." title="Type in a name">--}}
                    {{--<input class="form-control my-0 py-1 amber-border input-md" id="myInput" type="text" placeholder="Search product" aria-label="Search">--}}
                    <div class="input-group md-form form-sm form-2 pl-0">
                        <input class="form-control my-0 py-1 amber-border input-md" id="myInput" type="text" placeholder="Search product" aria-label="Search">
                        <div class="input-group-append">
                           <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fa fa-search text-grey" aria-hidden="true"></i></span>
                        </div>
                    </div>

                </div>

                <div class="col-12 col-sm-5 col-md-3 spaceleft-0  cart-list-icon">
                    <ul class="top-right-list">
                        {{--@if(Auth::check())--}}
                        {{--<li><a href="{{ url('/compare') }}"><img src="{{ asset('/frontend') }}/images/compare.png"> </a></li>--}}
                        {{--<li class="wishlist-header">--}}
                            {{--<a href="{{ url('/dashboard/wishlist') }}" class="wishlist">--}}
                                {{--<span class="badge badge-secondary" id="wishlist-count">{{ count(Auth::user()->wishlists) }}</span>--}}
                                {{--<img src="{{ asset('/frontend') }}/images/wishlist.png">--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--@else--}}
                        {{--<li><a href="{{ url('/compare') }}"><img src="{{ asset('/frontend') }}/images/compare.png"> </a></li>--}}
                        {{--<li class="wishlist-header">--}}
                            {{--<a data-toggle="modal" data-target="#loginModal" title="My wishlist" href="javascript:void(0)">--}}
                                {{--<img src="{{ asset('/frontend') }}/images/wishlist.png">--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--@endif--}}
                        <li class="wishlist-header ">
                            <a id="ShowDivButton " class="cart-header cart_icon showButton">
                                <span class="badge badge-secondary cart-header "> {{ Cart::instance('cart')->count() }}</span>
                                <img src="{{ asset('/frontend') }}/images/cart.png">
                                <span id="ViewBasketLink" class="ViewBasketLink">View<br>Basket</span>
                            </a>
                        </li>
                       <li>
                           <a class="btn btn-secondary checkout_style" href="" id="check_out">
                               Checkout

                           </a>
                       </li>
                    </ul>

                </div>

            </div>

        </div>

    </div>
    <?php $category = SM::getProductCategories(); ?>
    <div class="header-navi custom-style-menu">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-12">
                    <nav id="navbar_1" class="navbar navbar-expand-lg navbar-dark navbar-1 p-0 d-none d-lg-block">
                        <div class="collapse navbar-collapse" id="navbar_collapse_1">
                            <?php
                            $menu = array(
                                'nav_wrapper' => 'ul',
                                'start_class' => 'navbar-nav',
                                'link_wrapper' => 'li',
                                'dropdown_class' => 'dropdown open',
                                'home_class' => 'nav-item',
                                'a_class' => 'nav-link dropdown-toggle',
                                'subNavUlClass' => 'dropdown-menu',
                                'has_dropdown_wrapper_class' => 'dropdown open',
                                'show' => TRUE
                            );
                            SM::sm_get_menu($menu);
                            ?>

                        </div>

                    </nav>


                    <style>
                        .header-tile {
                            float: left;
                        }
                        .auth-buttons #login {
                            display: inline-block;
                        }
                        .btn-login-style {
                            /*background: #8F8F8F;*/
                            color: #fff;
                            font-family: 'Roboto';
                            /* font-family: 'Waitrose' !important; */
                            font-weight: 500;
                            letter-spacing: 2px;
                            font-size: 12px;
                        }
                        .auth-buttons>div, .auth-buttons>button {
                            display: inline;
                            margin-right: 2px;
                            /*vertical-align: middle;*/
                        }
                        .auth-buttons #login a, .auth-buttons #login .button-link {
                            display: inline-block;
                        }

                        .auth-buttons button.secondary, .auth-buttons .button.secondary {
                            padding-left: 7px;
                            padding-right: 7px;
                        }
                        .auth-buttons button, .auth-buttons .button {
                            box-sizing: border-box;
                            height: 33px;
                            line-height: 33px;
                            padding-top: 0;
                            padding-bottom: 0;
                        }
                        .secondary {
                            color: #333;
                        }
                        .auth-buttons .button {
                            border: 1px solid;
                            background-color: #646464;
                            border-color: #565656;
                            border-radius: 3px;
                            color: #fff;
                            cursor: pointer;
                            display: inline-block;
                            font: normal 12px 'Helvetica', 'Arial', sans-serif;
                            line-height: normal;
                            outline: none;
                            padding: 8px 8px;
                            position: relative;
                            text-align: center;
                            text-decoration: none;
                            vertical-align: middle;
                            white-space: nowrap;
                        }
                        /*-----------------------*/
                        .MspViewBasket {
                            /* position: relative; */
                            /* border: 0; */
                            /* cursor: pointer; */
                            /* -moz-border-radius: 0; */
                            /* -webkit-border-radius: 0; */
                            /* border-radius: 0; */
                            /* height: 40px; */
                            padding: 5px;
                            margin-top: 10px;
                            width: 112px;
                            margin-right: 5px;
                        }

                        .MspViewBasket {
                            display: inline-block;
                            margin-left: 10px;
                        }
                        .MspViewBasket .Notification {
                            background-color: #de1628;
                            border-radius: 11px;
                            color: #FFF;
                            font-size: 13px;
                            line-height: 22px;
                            position: relative;
                            left: 0;
                            text-align: center;
                            text-decoration: none;
                            top: 5px;
                            display: block;
                            width: 22px;
                            margin: 0 auto;
                            display: none;
                        }
                        .MspViewBasket .ProductCount.None {
                            visibility: hidden;
                        }


                        .MspViewBasket .ProductCount {
                            background-color: #9ebe1d;
                            border-radius: 11px;
                            color: #000;
                            font-weight: 600;
                            font-size: 12px;
                            line-height: 22px;
                            position: relative;
                            left: 10px;
                            text-align: center;
                            text-decoration: none;
                            top: -4px;
                            display: block;
                            width: 22px;
                            margin: 0 6px;
                            z-index: 3;
                        }
                        .MspViewBasket .Basket {
                            cursor: pointer;
                            display: block;
                            font-family: 'Open Sans',sans-serif;
                            font-weight: 600;
                            padding-right: 6px;
                            text-align: center;
                            text-decoration: none;
                            font-size: 20px;
                            height: 26px;
                            color: #5f5f5f;
                            position: relative;
                            top: -20px;
                            margin-left: 10px;
                        }
                        .MspViewBasket .Icon {
                            background-image: url(../../public/images/header_sprite-en-gb.png);
                            background-position: 0px -226px;
                            background-repeat: no-repeat;
                            width: 28px;
                            height: 27px;
                            display: inline-block;
                            float: left;
                            margin-left: 0;
                            top: 3px;
                            z-index: 2;
                            position: relative;
                        }
                        .MspViewBasket:hover .Icon {
                            background-image: url(../../public/images/header_sprite-en-gb.png);
                            background-position: -31px -223px;
                            background-repeat: no-repeat;
                            float: left;
                            margin-left: 0;
                            color:#fff;
                            z-index: 9999999;
                            top: 1px;
                        }

                        .MspViewBasket:hover .ViewBasketLink:after {
                            color:#fff;
                        }

                        .MspViewBasket .ViewBasketLink:hover{
                            color:#fff;
                        }
                        .MspViewBasket .ViewBasketLink {
                            display: inline-block;
                            font-family: 'Open Sans',sans-serif;
                            font-weight: 600;
                            font-size: 10px;
                            text-align: center;
                            text-transform: uppercase;
                            position: relative;
                            /*top: 3px;*/
                            color:#000;
                            vertical-align: top;
                            text-align: left;
                            margin-left: 11px;
                        }


                        .MspViewBasket:hover {
                            background-color: #5f5f5f;
                            border-radius: 4px;
                        }
                        .MspViewBasket .a .ViewBasketLink:hover {
                            color: #fff;
                        }
                        .MspViewBasket:hover:after .ViewBasketLink:hover:after {
                            color: #fff;
                        }
                        /*nav li a:hover:after{ width: 100%; }*/
                        /*---------------------*/
                        .navigation-style {
                            /* background: #fff; */
                            margin: 0;
                            /* margin-left: 0px; */
                            padding: 0px 22px 3px 22px;
                            margin-left: 20px;
                            border: 1px solid #b34040;
                        }
                        .style-navber{
                            color: #b34040;
                            font-size: 20px;
                            padding: 10px 0;
                        }
                    </style>

                    <nav id="navbar_2" class="navbar navbar-expand-lg navbar-dark navbar-2 p-0 d-block d-lg-none">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_collapse_2" aria-controls="navbar_collapse_2" aria-expanded="false" aria-label="Toggle navigation"> Menu </button>

                        <div class="collapse navbar-collapse" id="navbar_collapse_2">
                            <?php
                            $menu = array(
                                'nav_wrapper' => 'ul',
                                'start_class' => 'navbar-nav',
                                'link_wrapper' => 'li',
                                'dropdown_class' => 'dropdown open',
                                'home_class' => 'nav-item',
                                'a_class' => 'nav-link dropdown-toggle',
                                'subNavUlClass' => 'dropdown-menu',
                                'has_dropdown_wrapper_class' => 'dropdown open',
                                'show' => TRUE
                            );
                            SM::sm_get_menu($menu);
                            ?>
                        </div>
                    </nav>



                </div>

            </div>

        </div>

    </div>

</header>