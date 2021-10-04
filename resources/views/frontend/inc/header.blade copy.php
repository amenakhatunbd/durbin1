
<style>
.dropbtn {
  background-color: #f7921c;
  color: white;
  padding: 8px 14px;
  font-size: 16px;
  border: none;
  border-radius: 5px;
}
.dropbtn .fa{
    color: white !important;
}
.dropdown {
  position: relative;
  display: inline-block;
  top: 7px;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}


*{
    padding: 0;
    margin: 0;
}
body.wp_mm_enable{
    overflow: hidden;
}

/*
----------------------------------------------------------
------ Menu ----------------------------------------------
*/
.wp_mm_wrapper{
    height: calc(100vh - 60px);
    overflow-y: scroll;
    overflow-x: hidden;
    position: fixed;
    right: 0;
    bottom: 0;
    z-index: -9;
    width: 250px;
    opacity: 0;
    background-color: #000000;
    -webkit-transition: opacity 0.2s;
    -moz-transition: opacity 0.2s;
    transition: opacity 0.2s;

}
body.wp_mm_enable{
    overflow: hidden;
}
.body_overlay{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: hsla(0, 0%, 0%, 0.6);
    z-index: 998;
    display: none;
    opacity: 0;
    transition: opacity 0.2s;
}
.body_overlay.enabled{
    display: block;
    opacity: 1;
}
.wp_mm_wrapper.active{
    z-index: 999;
    opacity: 1;
}
.wp_mm_wrapper.active .nav-menu{
    display: block;
}
.wp_mm_wrapper .nav-menu li.back  a{
    font-size: 13px;
    width: 50%;
    margin-left: 80px;
    font-family: sans-serif;    
}
.wp_mm_wrapper .nav-menu a{
    display: block;
    color: #fff;
    padding: 20px 15px;
    letter-spacing: 1px;
    text-transform: uppercase;
    text-decoration: none;
    font-size: 14px;
    font-weight: 300;
    font-family: sans-serif

}
.wp_mm_wrapper .nav-menu .sub-menu{
    background-color: #000000;
    height: 100%;
    position: absolute;
    right: -100%;
    top: 0;
    transition: all 0.5s ease 0s;
    width: 100%;
    z-index: 999;
}
.wp_mm_wrapper .nav-menu li.active>.sub-menu{
    right: 0;
}
.wp_mm_wrapper .nav-menu li{
    list-style-type: none;
    border-bottom: 1px solid rgba(0, 0, 0, 0);
    border-image: linear-gradient(to right, rgba(0, 0, 0, 0) 0%, #fe2813 20%, #fe2813 50%, #fe2813 80%, rgba(0, 0, 0, 0) 100%) 0 0 1 0;
    height: 60px;
    color: #fff;
}
.wp_mm_wrapper .nav-menu li.menu-item-has-children>a{
    width: 50%;
}
.wp_mm_wrapper .nav-menu li.menu-item-has-children span{
    font-size: 24px;
    cursor: pointer;
    border: 1px solid;
    width: 50px;
    line-height: 1rem;
    text-align: center
}
span.forward{
    float: right;
    margin: 20px 10px 0 0;
}
span.left{
    float: left;
    margin: 20px 0 0 20px;
}

/*
----------------------------------------------------------
------ Toggle Menu ----------------------------------------------
*/

#toggle-menu{
    cursor: pointer;
    float: right;
    height: 25px;
    position: fixed;
    right: 5px;
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    transform: rotate(0deg);
    -webkit-transition: all 0.5s ease-in-out 0s;
    -moz-transition: all 0.5s ease-in-out 0s;
    -o-transition: all 0.5s ease-in-out 0s;
    transition: all 0.5s ease-in-out 0s;
    width: 30px;
    top: 15px;
    right: 15px;
    z-index: 9999;
}
#toggle-menu span{
    background-color: #FFFFFF;
    border-radius: 5px;
    display: block;
    height: 2px;
    left: 0;
    opacity: 1;
    position: absolute;
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    transform: rotate(0deg);
    -webkit-transition: all 0.25s ease-in-out 0s;
    -moz-transition: all 0.25s ease-in-out 0s;
    -o-transition: all 0.25s ease-in-out 0s;
    transition: all 0.25s ease-in-out 0s;
    width: 30px;
}
#toggle-menu span:nth-child(1) {
    top: 0;
}
#toggle-menu span:nth-child(2),
#toggle-menu span:nth-child(3) {
    top: 10px;
}
#toggle-menu span:nth-child(4) {
    top: 20px;
}
#toggle-menu.open span:nth-child(1) {
    left: 50%;
    top: 18px;
    width: 0;
}
#toggle-menu.open span:nth-child(2) {
    -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    transform: rotate(45deg);
}
#toggle-menu.open span:nth-child(3) {
    -webkit-transform: rotate(-45deg);
    -moz-transform: rotate(-45deg);
    transform: rotate(-45deg);
}
#toggle-menu.open span:nth-child(4) {
    left: 50%;
    top: 18px;
    width: 0;
}
#toggle-menu.open{
    /*background-color: #0F0;*/
}
@media screen and (max-width: 576px){
    .wp_mm_wrapper ul.menu li.back a {
        font-size: 12px;
        width: 100%;
        margin: 0px 0 0 80px;
        /* background-color: #2a2a2a; */
        padding: 25px 0px 20px 0;
    }
}
@media screen and (min-width:768px){

    .wp_mm_wrapper,
    #toggle-menu{
        /*display: none;*/
    }
}
@media screen and (min-width: 768px){
    #toggle-menu-container {
        width: 100%; 
    }
}
@media screen and (min-width:992px){

    body.wp_mm_enable {
        overflow: hidden;
    }
    #toggle-menu-container {
        width: 55px; 
    }
    .site-header nav{
        padding-right: 200px;
    }
    .body_overlay{
        display: none;
    }
    .wp_mm_wrapper,
    #toggle-menu,
    .body_overlay.enabled,
    #toggle-menu-container{
        display: initial;
    }
}

header{
    height: 60px;
    width: 100%;
    padding: 0;
    background-color: #4d0000;
    /*position: fixed;*/
}
.main-navigation.sticky-header{
    position: fixed;
    left: 0;
    right: 0;
    width: 100%;
    background-color: #333;
    /*box-shadow: 0 2px 6px rgba(255, 255, 255, 0.2);*/
    animation:slide-down 0.7s;
    z-index: 9999;
}
@keyframes slide-down {
    0% {
        opacity: 0;
        transform: translateY(-100%);
    }
    100% {
        opacity: 0.9;
        transform: translateY(0);
    }
}
.main-navigation {
    position: relative;
    float: left;
    width: 100%;
    display: none;
    clear: both;
    font-family:  sans-serif;
    text-transform: uppercase;
    background: #4d0000;

}

.main-navigation ul {
    list-style: none;
    margin: 0;
    padding-left: 0;
}


.main-navigation ul ul {
    float: left;
    position: absolute;
    top: 100%;
    left: -999em;
    z-index: 99999;
    background-color: rgba(158, 37, 32, 0.9);
}

.main-navigation ul ul ul {
    left: -999em;
    top: 0;

}

.main-navigation ul ul li:hover > ul,
.main-navigation ul ul li.focus > ul {
    left: 100%;
}

.main-navigation ul ul a {
    width: 200px;
}

.main-navigation ul li:hover > ul,
.main-navigation ul li.focus > ul {
    left: auto;
}

.main-navigation li {
    float: left;
    position: relative;
}

.main-navigation a {
    display: block;
    padding: 1em .8em;
    font-size: 14px;
    text-decoration: none;
    line-height: 1.3em;
    color: #fdb84e;
}
.main-navigation li:hover > a {
    color: #fff;
    color: hsl(0, 0%, 100%);
    background: #7ac1b7;
}
.main-navigation ul ul a:hover {

}
.main-navigation .current_page_item > a,
.main-navigation .current-menu-item > a,
.main-navigation .current_page_item > a:hover,
.main-navigation .current-menu-item > a:hover {
    color: #313131;
    background: #7ac1b7;
}
.main-navigation .current_page_ancestor {
    background: #4d4d4d;
    background: hsl(0, 0%, 30%);
    /*border: 1px solid #F00;*/
}


.main-navigation .current_page_parent .current_page_item > a {
    color: #313131;
    background: #7ac1b7;
}

div.lorem-content{  padding: 2rem 0;
                    background-color: #ececec;
}
div.lorem-content h1{
    margin: 10px auto;
}
@media screen and (min-width:992px) {

    .main-navigation,
    .main-navigation ul{
        display: block;
    }
}



</style>


<div class="wow fadeInDown">

<nav class="navbar navbar-default main-navber" id="stcky-header">

    <div class="container">

        <div class="navbar-header">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

            </button>

            <a class="navbar-brand" href="{{url('/')}}">

                <img align="{{ SM::get_setting_value('site_name') }}"

                     src="{{ SM::sm_get_the_src(SM::sm_get_site_logo(), 230, 50) }}" class="img-responsive">

            </a>

        </div>

        <div class="collapse navbar-collapse" id="myNavbar">

            <div class="header_search_bar_section">
                <form class="navbar-form navbar-left">
                    <div class="input-group">
                            <!-- searchProduct  -->
                        <!--<input type="text" class="form-control type" id="searchProduct" name="search">-->
                        <input type="text" class="form-control type" id="searchProduct">
                        <div class="input-group-btn">
    
                            <button class="btn btn-default" disabled>
    
                                <i class="glyphicon glyphicon-search"></i>
    
                            </button>
                         
                        </div>
    
                    </div>
    
                </form>
            </div>

            <ul class="nav navbar-nav navbar-right" id="navbar-mid">

                <li class="single_cart_list">

                    <a href="{{ url('/cart') }}"><i class="icofont-cart"></i>
                    <?php 
                        $cart_qty = Cart::instance('cart')->count();
                    
                    ?>
                        @if( $cart_qty> 0)
                        <span class="badge cart_count">{{ Cart::instance('cart')->count() }}</span>
                        @else
                        <span class="badge cart_count"></span>
                        @endif

                    </a>

                </li>

                @if(Auth::check())
                <li class="single_dashboard">
                    <!--  <a href="#" class="btn btn-default >{{Auth::user()->name}}-->
                    <!--  <span class="caret"></span>-->
                    <!--  </a>-->
                    <!--  <ul class="dropdown-menu my-drobdown">-->
                    <!--    <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>-->
                    <!--    <li><a href="{{url('/logout')}}" class="nav-link -before">Logout</a></li>-->
                    <!--  </ul>-->
                    
                    <div class="dropdown">
                      <button class="dropbtn"><i class="fa fa-user"></i></button>
                      <div class="dropdown-content">
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                        <a href="{{url('/logout')}}">Logout</a>
                      </div>
                    </div>
                </li>
                @else

                    <li class="sign_up_list">

                        <!--<a data-toggle="modal" data-target="#loginModal" href="#" class="btn btn-default">Sign in</a>-->
                        <a href="{{ url('/login_signin_new') }}" class="btn btn-default">Sign in</a>

                    </li>

                @endif

            </ul>

        </div>

    </div>

</nav>


<header id="masthead">
<nav id="site-navigation" class="main-navigation sticky-active" role="navigation">
    <ul id="primary-menu" class="menu nav-menu" aria-expanded="false">
        <li id="menu-item-732" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-732"><a href="#">Home</a></li>
        <li id="menu-item-733" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-733"><a href="#">Blog</a></li>
        <li id="menu-item-734" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-734"><a href="#">Front Page</a></li>
        <li id="menu-item-739" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-739">
            <a href="#">Level 1</a>
            <ul class="sub-menu">
                <li id="menu-item-740" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-740">
                    <a href="#">Level 2</a>
                    <ul class="sub-menu">
                        <li id="menu-item-741" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-741"><a href="#">Level 3</a></li>
                        <li id="menu-item-1453" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1453"><a href="#">Level 3a</a></li>
                        <li id="menu-item-1454" class="menu-item menu-item-type-post_type menu-item-has-children menu-item-object-page menu-item-1454">
                            <a href="#">Level 3b</a>
                            <ul class="sub-menu">
                                <li><a href="#">Level 3b 1</a></li>
                                <li><a href="#">Level 3b 2</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li id="menu-item-1455" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1455"><a href="#">Level 2a</a></li>
                <li id="menu-item-1456" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1456"><a href="#">Level 2b</a></li>
            </ul>
        </li>
        <li id="menu-item-735" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-735">
            <a href="#">About The Tests</a>
            <ul class="sub-menu">
                <li id="menu-item-1451" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1451"><a href="#">Page Image Alignment</a></li>
                <li id="menu-item-1452" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1452"><a href="#">Page Markup And Formatting</a></li>
                <li id="menu-item-736" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-736"><a href="#">Clearing Floats</a></li>
                <li id="menu-item-737" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-737"><a href="#">Page with comments</a></li>
                <li id="menu-item-738" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-738"><a href="#">Page with comments disabled</a></li>
            </ul>
        </li>
        <li id="menu-item-742" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-742"><a href="#">Lorem Ipsum</a></li>
        <li id="menu-item-1457" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1457"><a href="#">Page A</a></li>
        <li id="menu-item-1458" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1458 menu-item-has-children">
            <a href="#">Page B</a>
            <ul class="sub-menu">
                <li><a href="#">Page B 1</a></li>
                <li><a href="#">Page B 2</a></li>
            </ul>
        </li>
    </ul>
</nav>
</header>

<section class="navtabs-section">

    <div class="container-fluid">

        <div class="row">

            <div class="custom-navtabs main-menu">

                <?php

                $menu = array(

                    'nav_wrapper' => 'ul',

                    'start_class' => 'nav nav-tabs',

                    'link_wrapper' => 'li',

                    'dropdown_class' => 'dropdown ',

                    'home_class' => '',

                    'a_class' => '',

                    'subNavUlClass' => 'dropdown-menu',

                    'has_dropdown_wrapper_class' => 'dropdown',

                    'show' => TRUE

                );

                SM::sm_get_menu($menu);
                

                ?> 

                <div class="container">

                    <div class="tab-content">

                        @if(Request::segment(1) == '')

                            <div id="home" class="tab-pane fade in active">

                                <nav class="navbar navbar-default sub-main-menu">

                                    <ul class="nav navbar-nav">
                                        
                                        <li class="dropdown mega-dropdown">

                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">প্রকাশনী <span

                                                        class="caret"></span></a>

                                            <ul class="dropdown-menu mega-dropdown-menu">

                                                <?php

                                                $publishers = \App\Model\Common\Publisher::Published()->select('title','slug','id')->limit(40)->get();

                                                ?>

                                                @foreach($publishers->chunk(5) as $chunk)

                                                    <li class="col-sm-3">

                                                        <ul>

                                                            @foreach($chunk as $publisher)

                                                                <li>

                                                                    <!--<a href="{{ url('publisher', $publisher->slug) }}"> {{ $publisher->title }} </a>-->
                                                                    <a href="{{ url('/publisher', $publisher->slug) }}"> {{ $publisher->title }} </a>

                                                                </li>

                                                            @endforeach

                                                        </ul>

                                                    </li>

                                                @endforeach
                                                
                                                <li class="pull-right col-sm-3"><a href="{{ url('/all_publishers') }}"> see more.. </a></li>

                                            </ul>

                                        </li>

                                        <li class="dropdown mega-dropdown">

                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">লেখক <span

                                                        class="caret"></span></a>

                                            <ul class="dropdown-menu mega-dropdown-menu">

                                                <?php

                                                $authors = \App\Model\Common\Author::Published()->select('title','slug','id')->limit(40)->get();

                                                ?>

                                                @foreach($authors->chunk(5) as $chunk)

                                                    <li class="col-sm-3">

                                                        <ul>

                                                            @foreach($chunk as $author)

                                                                <li>

                                                                    <a href="{{ url('author', $author->slug) }}"> {{ $author->title }} </a>

                                                                </li>

                                                            @endforeach

                                                        </ul>

                                                    </li>

                                                @endforeach
                                                
                                                <li class="pull-right col-sm-3"><a href="{{ url('/all_authors') }}"> see more.. </a></li>

                                            </ul>

                                        </li>

                                        <li class="dropdown mega-dropdown">

                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">বিষয় <span

                                                        class="caret"></span></a>

                                            <ul class="dropdown-menu mega-dropdown-menu">

                                                <?php

                                                $categorys = \App\Model\Common\Category::Published()->select('title','slug','id')->limit(40)->get();

                                                ?>

                                                @foreach($categorys->chunk(5) as $chunk)

                                                    <li class="col-sm-3">

                                                        <ul>

                                                            @foreach($chunk as $category)

                                                                <li>

                                                                    <a href="{{ url('category', $category->slug) }}"> {{ $category->title }} </a>

                                                                </li>

                                                            @endforeach

                                                        </ul>

                                                    </li>

                                                @endforeach
                                                
                                                <li class="pull-right col-sm-3"><a href="{{ url('/all_categories') }}"> see more.. </a></li>

                                            </ul>

                                        </li>

                                        

                                        <li class="mega-dropdown"><a href="{{ url('category', 'দূরবীন-অফার') }}">দূরবীন অফার </a></li>
                                        <li class="mega-dropdown"><a href="{{ url('category', 'ইসলামিক-বই') }}">ইসলামিক বই </a></li>

                                        <?php

                                        $sub_menus = SM::SubMenuCategory('book');

                                        ?>

                                        @include('frontend.common.sub_menu', ['sub_menus' => $sub_menus])

                                    </ul>

                                </nav>

                            </div>

                        @elseif(Request::segment(1) == 'category' )

                            <div id="home" class="tab-pane fade in active">

                                <nav class="navbar navbar-default sub-main-menu">

                                    <ul class="nav navbar-nav">

                                        <?php

                                        $sub_menus = SM::SubMenuCategory(Request::segment(2))

                                        ?>

                                        @include('frontend.common.sub_menu', ['sub_menus' => $sub_menus])

                                    </ul>

                                </nav>

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

</div>



    <script>
            var droCatererMainMenu = $('.main-navigation ul.menu').clone();
            $(droCatererMainMenu).droSlidingMenu();






/**
 * WordPress JQuery Mobile Menu
 *
 * Inspired from JQuery Simple MobileMenu : https://github.com/Position2/jQuery-Simple-MobileMen
 *
 */

(function ($) {
    var defaults = {
                    "toggleMenuId"              :   "toggle-menu",
                    "toggleMenuContainerId"     :   "toggle-menu-container",
                    "toggleMenuContainerClass"  :   "toggle-menu-container-class",
                    "wrapperClass"              :   "wp_mm_wrapper",
                    "submenuClass"              :   "sub-menu",
                    "bodyOverlayClass"          :   "body_overlay"
    };
    $.fn.droSlidingMenu = function (options) {
        if ($(this).length === 0) { return this ;}
        var droMenu = {}, ds = $(this);
        var init = function () {
            droMenu.settings = $.extend({}, defaults, options);
            createWrappers();
            createBackButton();
            createRightNavButton();
        },
        createWrappers = function () {
            droMenu.toggleControl           = $("<div/>", {"id": droMenu.settings.toggleMenuId,
                                                 "html": "<span></span><span></span><span></span><span></span>"}),
            droMenu.toggleControlContainer  = $("<div/>",{"id": droMenu.settings.toggleMenuContainerId,
                                                  "class": droMenu.settings.toggleMenuContainerClass}),
            droMenu.wrapperControl          = $("<div/>", {"class": droMenu.settings.wrapperClass});
            droMenu.bodyOverlay             = $("<div/>", {"class": droMenu.settings.bodyOverlayClass});
            ds.appendTo(droMenu.wrapperControl);
            droMenu.toggleControl.prependTo(droMenu.toggleControlContainer);
            droMenu.toggleControlContainer.prependTo($("#masthead"));
            droMenu.bodyOverlay.add(droMenu.wrapperControl).appendTo($("body"));
        },
        createRightNavButton = function () {
            droMenu.wrapperControl.find("li.menu-item-has-children").each(function () {
                var rightNavButton = $("<span/>", {"class": "ion-ios-arrow-forward forward"});
                rightNavButton.prependTo($(this));
            });
        },
        createBackButton = function () {
            droMenu.wrapperControl.find("ul." + droMenu.settings.submenuClass).each(function () {
                var dis         = $(this),
                    disPar      = dis.closest("li"),
                    disA        = disPar.find(">a"),
                    disIconBack = $("<span/>", {"class": "ion-ios-arrow-back left"}),
                    disBack     = $("<li/>", {"class": "back",
                                      "html": "<a href='" + disA.attr('href') + "'>" + disA.text() + "</a>"});
                disIconBack.prependTo(disBack);
                disBack.prependTo(dis);
            });
        },
        openCurrentPage = function(){
            /**
             * Syn the mobile menu with the current page
             **/
            droMenu.wrapperControl.find("li.current-page-parent , li.current-menu-parent, li.current-menu-ancestor")
                .addClass("active").siblings().removeClass("active");
        },
        toggleMobileMenu = function () {
            $("#" + droMenu.settings.toggleMenuId).toggleClass("open");
            $("." + droMenu.settings.bodyOverlayClass).toggleClass("enabled");
            /*
            * keep the current item opened
            * to back to the home item add : .find("li.active").removeClass("active")
            */
            $("." + droMenu.settings.wrapperClass).toggleClass("active");
            $("body").toggleClass("wp_mm_enable");
        },
        showSubMenu = function (e) {
            e.preventDefault();
            $("." + droMenu.settings.wrapperClass).scrollTop(0);
            $(this).parent().addClass("active").siblings().removeClass("active");
        },
        goBack = function (e) {
            e.preventDefault();
            $(this).closest("ul." + droMenu.settings.submenuClass).parent().removeClass("active");
        };

        init();
        openCurrentPage();
        droMenu.toggleControl.click(toggleMobileMenu);
        droMenu.bodyOverlay.click(toggleMobileMenu);
        droMenu.wrapperControl.find("li.menu-item-has-children > span").click(showSubMenu);
        droMenu.wrapperControl.find("li.back > span").click(goBack);
    };
})(jQuery);

        </script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script>
try {
  fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", { method: 'HEAD', mode: 'no-cors' })).then(function(response) {
    return true;
  }).catch(function(e) {
    var carbonScript = document.createElement("script");
    carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
    carbonScript.id = "_carbonads_js";
    document.getElementById("carbon-block").appendChild(carbonScript);
  });
} catch (error) {
  console.log(error);
}
</script>



