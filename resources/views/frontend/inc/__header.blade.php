<input type="hidden" name="_token" id="table_csrf_token" value="{!! csrf_token() !!}">
<?php
$mobile = SM::get_setting_value('mobile');
$email = SM::get_setting_value('email');
$address = SM::get_setting_value('address');
$country = SM::get_setting_value('country');
if (Auth::check()) {
    $blogAuthor = Auth::user();
    $fname = $blogAuthor->firstname . " " . $blogAuthor->lastname;
    $fname = trim($fname) != '' ? $fname : $blogAuthor->username;
} else {
    $fname = 'My Account';
    $logonMoadal = 'data-toggle="modal" data-target="#loginModal"';
}
?>
<div id="header" class="header">
    <div class="top-header">
        <div class="container">
            <div class="currency">
                <a class="header-top-text" href="#">Sign up and Get 10% off on your first order</a>
            </div>
            <div class="currency">
                <a class="header-top-text"><i class="fa fa-truck"></i> Free Shipping across </a>
            </div>

            <div class="support-link">
                <a href="#" class="header-top-text"><i class="fa fa-phone"></i>{{ $mobile }}</a>

            </div>

            <div class="switcher currency switcher-currency" id="switcher-currency-nav">
                <strong class="label switcher-label">Currency :</strong>

                <div class="actions dropdown options switcher-options">
                    {!! Form::open(["method"=>"post","route"=>"currency_change"]) !!}

                    <select class="customDropDown form-control currencySelectOption" name="currency" data-target="dropdown">
                        <?php
                        foreach (SM::countryCurrency() as $key => $country) {
                     
                            $cookie_name = 'countryCurrency';
                            if (isset($_COOKIE[$cookie_name])) {
                                if ($_COOKIE[$cookie_name] == $country->id) {
                                    $selected = 'selected';
                                } else {
                                    $selected = '';
                                }
                            } else {
                                if (SM::get_setting_value('currency') == $country->currency_code) {
                                    $selected = 'selected';
                                } else {
                                    $selected = '';
                                }
                            }
                            echo '<option ' . $selected . ' value="' . $country->id . '" >' . $country->currency_code . ' - ' . $country->name . '</option>';
                        }
                        ?>

                    </select>
                    {!! Form::close() !!}
                </div>
            </div>
            <div id="user-info-top" class="user-info pull-right">
                <div class="dropdown">
                    <a class="current-open" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       href="#"><span>{{ $fname }}</span></a>
                    <ul class="dropdown-menu mega_dropdown" role="menu">
                        @if(Auth::check())
                            <li><a href="{{'/dashboard'}}">Profile</a></li>
                            <li><a href="{{ url('/dashboard/wishlist') }}">Wishlists</a></li>
                            <li><a href="{{'/logout'}}">Logout</a></li>
                        @else
                            <li><a href="#" data-toggle="modal" data-target="#loginModal">Login</a></li>
                            <li><a data-toggle="modal" data-target="#loginModal" href="#">Wishlists</a></li>
                            <li><a href="{{ url('/compare') }}">Compare</a></li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--/.top-header -->
    <!-- MAIN HEADER -->
    <div class="header-middle">
        <div class="container main-header">
            <div class="row">
                <div class="col-xs-4 col-sm-4 logo">
                    <a href="{{ url('/') }}">
                        <img alt="{{ SM::get_setting_value('site_name') }}"
                             src="{{ SM::sm_get_the_src(SM::sm_get_site_logo(), 300, 63) }}"/>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-4 header-search-box">
                    <div class="WelcomeMassage">Welcome, We ship worldwide</div>
                    <form class="form-inline">
                        <div class="form-group input-serach" id="main_search">
                            <input autocomplete="off" id="search_text" type="text" name="search_text"
                                   placeholder="Keyword here...">
                        </div>
                        <button type="submit" class="pull-right btn-search"></button>
                    </form>
                </div>
                <div class="col-xs-8 col-sm-4 group-button-header header_cart_html">
                    <ul class="style-button pull-right">
                        <div class="btn-cart" id="cart-block">
                            <li>
                                <a href="{{ url('/cart') }}">
                                    <span class="icon"><i class="fa fa-shopping-cart"></i></span>
                                    <p class="topwishlist-text">CART( {{ Cart::instance('cart')->count() }} )</p>
                                </a>
                            </li>
                            <span class="notify notify-right">{{ Cart::instance('cart')->count() }}</span>
                            <div class="cart-block">
                                <div class="cart-block-content">
                                    <h5 class="cart-title">{{ Cart::instance('cart')->count() }} Items in my cart</h5>
                                    <div class="cart-block-list">
                                        <ul>
                                            <?php
                                            $items = Cart::instance('cart')->content();
                                            ?>                         
                                            @forelse($items as $id => $item)
                                                <li class="product-info">
                                                    <div class="p-left">
                                                        <a data-product_id="{{ $item->rowId }}"
                                                           class="remove_link removeToCart"
                                                           title="Delete item"
                                                           href="javascript:void(0)"></a>
                                                        <a href="{{ url('product/'.$item->options->slug) }}">
                                                            <img class="img-responsive"
                                                                 src="{{ SM::sm_get_the_src($item->options->image, 100, 122) }}"
                                                                 alt="{{ $item->name }}">
                                                        </a>

                                                    </div>
                                                    <div class="p-right">
                                                        <p class="p-name">{{ $item->name }}</p>
                                                        <p class="p-rice">{{ SM::currency_price_value($item->price) }}</p>
                                                        <p>Qty: {{ $item->qty }}</p>
                                                        @if($item->options->sizename != '')
                                                            <p>Size: {{ $item->options->sizename }}</p>
                                                        @endif
                                                        @if($item->options->colorname != '')
                                                            <p>Color: {{ $item->options->colorname }}</p>
                                                        @endif
                                                    </div>
                                                </li>
                                            @empty
                                                <p>No data found!</p>
                                            @endforelse
                                        </ul>
                                    </div>
                                    <div class="toal-cart">
                                        <span>Total</span>
                                        <span class="toal-price pull-right">{{ SM::currency_price_value(Cart::instance('cart')->subTotal()) }}</span>
                                    </div>
                                    <div class="cart-buttons">
                                        <a href="{{ url('/cart') }}" class="btn-check-out">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>

                    @if(Auth::check())
                        <ul class="style-button pull-right">
                            <li>
                                <a title="My wishlist" href="{{ url('/dashboard/wishlist') }}">
                                    <span class="icon"><i class="fa fa-heart"></i></span>
                                    <p class="topwishlist-text">WISHLIST( {{ count(Auth::user()->wishlists) }} )</p>
                                </a>
                            </li>
                        </ul>
                    @else
                        <ul class="style-button pull-right">
                            <li>
                                <a data-toggle="modal" data-target="#loginModal" title="My wishlist"
                                   href="javascript:void(0)">
                                    <span class="icon"><i class="fa fa-heart"></i></span>
                                    <p class="topwishlist-text">WISHLIST( 0 )</p>
                                </a>
                            </li>
                        </ul>
                    @endif
                    <ul class="style-button pull-right">
                        <li>
                            <a href="{{ url('/compare') }}"
                               title="My Compare">
                                <span class="icon"><i class="fa fa-retweet"></i></span>
                                <p class="topwishlist-text">COMPARE( {{ Cart::instance('compare')->count() }} )</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!-- END MANIN HEADER -->
    <div id="nav-top-menu" class="nav-top-menu">
        <div class="container">

            <div id="main-menu" class="col-sm-12 main-menu">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <i class="fa fa-bars"></i>
                            </button>
                            <a class="navbar-brand" href="#">MENU</a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <?php
                            $menu = array(
                                'nav_wrapper' => 'ul',
                                'start_class' => 'nav navbar-nav',
                                'link_wrapper' => 'li',
                                'dropdown_class' => '',
                                'subNavUlClass' => 'dropdown-menu mega_dropdown',
                                'has_dropdown_wrapper_class' => 'dropdown',
                                'show' => TRUE
                            );
                            SM::sm_get_menu($menu);
                            ?>

                        </div><!--/.nav-collapse -->
                    </div>
                </nav>
            </div>

            <!-- userinfo on top-->
            <div id="form-search-opntop">

            </div>
            <!-- userinfo on top-->
            <div id="user-info-opntop">
            </div>
            <!-- CART ICON ON MMENU -->
            <div id="shopping-cart-box-ontop" class="cart_icon">
                <i class="fa fa-shopping-cart"></i>
                <div class="shopping-cart-box-ontop-content"></div>
            </div>
        </div>
    </div>
</div>