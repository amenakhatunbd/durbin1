<div class="main_navbar_header_section">
    <nav class="navbar navbar-default main_navber_header" id="stcky-header">
        <div class="container">
            <div class="row">
                <div class="col-md-lg col-md-2 col-sm-2">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{url('/')}}">
                            <img align="{{ SM::get_setting_value('site_name') }}"
                                src="{{ SM::sm_get_the_src(SM::sm_get_site_logo(), 230, 50) }}" class="img-responsive">
                        </a>
                        <ul class="nav navbar-nav navbar-right" id="Mobile_navbar_cart_section">
                            <li class="single_cart_list">
                                <a href="{{ url('/cart') }}"><i class="fa fa-shopping-basket"></i>
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
                                <div class="dropdown">
                                    <button class="dropbtn">
                                        <?php $userInfo  = Auth::user(); ?>

                                        @if(!empty($userInfo->image))
                                        <img id="profile_picture_img"
                                            src="{!! SM::sm_get_the_src($userInfo->image,165,165) !!}"
                                            alt="{{ $userInfo->username }}">
                                        @else
                                        <img id="profile_picture_img" src="{{ asset('images/writer-icon.png') }}"
                                            alt="{{ $userInfo->username }}">
                                        @endif
                                        <div class="dropdown-content">
                                            <a href="{{ url('/dashboard') }}">Dashboard</a>
                                            <a href="{{url('/logout')}}"> <i class="fa fa-sign-out"></i> Logout</a>
                                        </div>
                                </div>
                            </li>
                            @else
                            <li class="sign_up_list">
                                <a href="{{ url('/login_signin_new') }}" class="btn btn-default"> <i
                                        class="fa fa-sign-in"></i></a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-6">
                    <div class="header_search_bar_section">
                        <form action="" autocomplete="off" class="navbar-form" method="post" accept-charset="utf-8">
                            <div class="input-group col-lg-12">

                                <input name="searchtext" style="width:100%" id="searchProduct" value="" class="form-control type" type="text" placeholder=" book, author ">

                                <span class="input-group-btn">
                                    <button class="btn btn-default" disabled>
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-4">
                    <ul class="nav navbar-nav navbar-right" id="main_navbar_cart_section">
                        <li>
                            <a href="#" class="hotline_number"> <i class="fa fa-phone"></i> <span>0125468450</span></a>
                        </li>
                        <li class="single_cart_list">
                            <a href="{{ url('/cart') }}"><i class="fa fa-shopping-basket"></i>
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
                            <div class="dropdown">
                                <button class="dropbtn">
                                    <?php $userInfo  = Auth::user(); ?>

                                    @if(!empty($userInfo->image))
                                    <img id="profile_picture_img"
                                        src="{!! SM::sm_get_the_src($userInfo->image,165,165) !!}"
                                        alt="{{ $userInfo->username }}">
                                    @else
                                    <img id="profile_picture_img" src="{{ asset('images/writer-icon.png') }}"
                                        alt="{{ $userInfo->username }}">
                                    @endif
                                    <div class="dropdown-content">
                                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                                        <a href="{{url('/logout')}}"> <i class="fa fa-sign-out"></i> Logout</a>
                                    </div>
                            </div>
                        </li>
                        @else
                        <li class="sign_up_list">
                            <a href="{{ url('/login_signin_new') }}" class="btn btn-default"> <i
                                    class="fa fa-sign-in"></i> Sign in</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    
    <header class="main_navbar_seciton">
        <nav>
            <div class="wrapper">
                <ul class="nav-links">
                    <label for="close-btn" class="btn close-btn"><i class="fas fa-times"></i></label>
                    <li><a href="{{url('/')}}">বই</a></li>
                    <li><a href="{{url('category/gift-item')}}">গিফট</a></li>
                    <li><a href="{{url('category/গ্যাজেট')}}">গ্যাজেট</a></li>
                    <li><a href="{{url('category/কর্পোরেট-অর্ডার')}}">কর্পোরেট অর্ডার</a></li>
                    @php
                    $publishers =
                    \App\Model\Common\Publisher::Published()->select('title','slug','id')->limit(39)->get();
                    @endphp
                    <li>
                        <a href="#" class="desktop-item">প্রকাশনী</a>
                        <input type="checkbox" id="showMega">
                        <label for="showMega" class="mobile-item">Mega Menu</label>
                        <div class="mega-box">
                            <div class="content">
                                <ul class="list-unstyled">
                                    @foreach($publishers as $key => $publisher)
                                    <li class="col-lg-3 col-6"><a
                                            href="{{ url('/publisher', $publisher->slug) }}">{{$publisher->title}}</a>
                                    </li>
                                    @endforeach
                                    <li class="pull-right col-sm-3"><a href="{{ url('/all_publishers') }}"> see more..
                                        </a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    @php
                    $authors = \App\Model\Common\Author::Published()->select('title','slug','id')->limit(39)->get();
                    @endphp
                    <li>
                        <a href="#" class="desktop-item">লেখক</a>
                        <input type="checkbox" id="showMega">
                        <label for="showMega" class="mobile-item">Mega Menu</label>
                        <div class="mega-box">
                            <div class="content">
                                <ul class="list-unstyled">
                                    @foreach($authors as $key => $author)
                                    <li class="col-lg-3 col-6"><a
                                            href="{{ url('/author', $author->slug) }}">{{$author->title}}</a></li>
                                    @endforeach
                                    <li class="pull-right col-sm-3"><a href="{{ url('/all_authors') }}"> see more.. </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    @php
                    $categorys =
                    \App\Model\Common\Category::Published()->select('title','slug','id')->limit(39)->get();
                    @endphp
                    <li>
                        <a href="#" class="desktop-item">বিষয়</a>
                        <input type="checkbox" id="showMega">
                        <label for="showMega" class="mobile-item">Mega Menu</label>
                        <div class="mega-box">
                            <div class="content">
                                <ul class="list-unstyled">
                                    @foreach($categorys as $key => $category)
                                    <li class="col-lg-3 col-6"><a
                                            href="{{ url('/category', $category->slug) }}">{{$category->title}}</a></li>
                                    @endforeach
                                    <li class="pull-right col-sm-3"><a href="{{ url('/all_categories') }}"> see more..
                                        </a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li><a href="{{ url('category', 'দূরবীন-অফার') }}">দূরবীন অফার</a></li>
                    <li><a href="{{ url('category', 'ইসলামিক-বই') }}">ইসলামিক বই</a></li>
                    <li><a href="{{url('blog')}}">ব্লগ</a></li>
                </ul>
            </div>
        </nav>



        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <div class="collapse navbar-collapse" id="main_nav">
                    <ul class="navbar-nav mx-auto">

                        <li class="nav-item active"><a class="nav-link" href="{{url('/')}}"> বই </a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('category/gift-item')}}"> গিফট </a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('category/গ্যাজেট')}}"> গ্যাজেট </a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('category/কর্পোরেট-অর্ডার')}}"> কর্পোরেট
                                অর্ডার </a></li>
                        @php
                        $publishers =
                        \App\Model\Common\Publisher::Published()->select('title','slug','id')->limit(39)->get();
                        @endphp
                        <li class="nav-item dropdown has_megamenu">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> প্রকাশনী </a>
                            <div class="dropdown-menu megamenu" role="menu">
                                <ul class="list-unstyled">
                                    @foreach($publishers as $key => $publisher)
                                    <li class="col-lg-3 col-6"><a
                                            href="{{ url('/publisher', $publisher->slug) }}">{{$publisher->title}}</a>
                                    </li>
                                    @endforeach
                                    <li class="pull-right col-sm-3"><a href="{{ url('/all_publishers') }}"> see more..
                                        </a></li>
                                </ul>
                            </div>
                        </li>
                        @php
                        $authors = \App\Model\Common\Author::Published()->select('title','slug','id')->limit(39)->get();
                        @endphp
                        <li class="nav-item dropdown has_megamenu">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> লেখক </a>
                            <div class="dropdown-menu megamenu" role="menu">
                                <ul class="list-unstyled">
                                    @foreach($authors as $key => $author)
                                    <li class="col-lg-3 col-6"><a
                                            href="{{ url('/author', $author->slug) }}">{{$author->title}}</a></li>
                                    @endforeach
                                    <li class="pull-right col-sm-3"><a href="{{ url('/all_authors') }}"> see more.. </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @php
                        $categorys =
                        \App\Model\Common\Category::Published()->select('title','slug','id')->limit(39)->get();
                        @endphp
                        <li class="nav-item dropdown has_megamenu">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">বিষয়</a>
                            <div class="dropdown-menu megamenu" role="menu">
                                <ul class="list-unstyled">
                                    @foreach($categorys as $key => $category)
                                    <li class="col-lg-3 col-6"><a
                                            href="{{ url('/category', $category->slug) }}">{{$category->title}}</a></li>
                                    @endforeach
                                    <li class="pull-right col-sm-3"><a href="{{ url('/all_categories') }}"> see more..
                                        </a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('category', 'দূরবীন-অফার') }}"> দূরবীন
                                অফার </a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('category', 'ইসলামিক-বই') }}"> ইসলামিক বই
                            </a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('blog')}}"> ব্লগ </a></li>


                    </ul>
                </div>
            </div>
        </nav>
    </header>
</div>


<div class="mobile_menu_section">
    <div class="zeynep right" id="mobile_menu_section_items">
        <ul>
            <li> <a href="{{url('/')}}">বই</a></li>
            <li><a href="{{url('category/gift-item')}}">গিফট</a></li>
            <li> <a href="{{url('category/গ্যাজেট')}}">গ্যাজেট</a></li>
            <li><a href="{{url('category/কর্পোরেট-অর্ডার')}}">কর্পোরেট অর্ডার</a></li>
            <li class="has-submenu">
                <a href="#" data-submenu="stores">প্রকাশনী</a>

                <div id="stores" class="submenu">
                    <label>প্রকাশনী</label>
                    <ul>
                        @foreach($publishers as $key => $publisher)
                        <li><a href="{{ url('/publisher', $publisher->slug) }}">{{$publisher->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </li>
            <li class="has-submenu">
                <a href="#" data-submenu="stores">লেখক</a>

                <div id="stores" class="submenu">
                    <div class="submenu-header">
                        <a href="#" data-submenu-close="stores">Main Menu</a>
                    </div>
                    <label>লেখক</label>
                    <ul>
                        @foreach($authors as $key => $author)
                        <li><a href="{{ url('/author', $author->slug) }}">{{$author->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </li>
            <li class="has-submenu">
                <a href="#" data-submenu="stores">বিষয়</a>

                <div id="stores" class="submenu">
                    <div class="submenu-header">
                        <a href="#" data-submenu-close="stores">Main Menu</a>
                    </div>
                    <label>বিষয়</label>
                    <ul>
                        @foreach($categorys as $key => $category)
                        <li><a href="{{ url('/category', $category->slug) }}">{{$category->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </li>
            <li><a href="{{url('blog')}}"> ব্লগ </a></li>
        </ul>
    </div>

    <main>
        <button type="button" class="btn-open first"><i class="fa fa-bars"></i></button>
    </main>
    <div class="zeynep-overlay"></div>
</div>








<script>
    // main menu seciton script

    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.dropdown-menu').forEach(function (element) {
            element.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        })
    });


    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.main_navbar_header_section').addClass('main_navbar_stcky')
        } else {
            $('.main_navbar_header_section').removeClass('main_navbar_stcky')
        }
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.mobile_menu_section').addClass('main_navbar_stcky_mobile')
        } else {
            $('.mobile_menu_section').removeClass('main_navbar_stcky_mobile')
        }
    });




    $(function () {
        var zeynep = $('.zeynep').zeynep({
            opened: function () {
                // log
                console.log('the side menu opened')
            },
            closed: function () {
                // log
                console.log('the side menu closed')
            }
        })

        zeynep.on('closing', function () {
            // log
            console.log('this event is dynamically binded')
        })

        $('.zeynep-overlay').on('click', function () {
            zeynep.close()
        })

        $('.btn-open').on('click', function () {
            zeynep.open()
        })






    })
</script>