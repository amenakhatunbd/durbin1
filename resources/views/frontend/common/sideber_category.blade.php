<nav id="categories" class="navbar navbar-expand-lg p-0 categories">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-categories"
            aria-controls="navbar-categories" aria-expanded="false" aria-label="Toggle navigation">
        All Categories
    </button>
    <style>
        .categories .navbar-nav li {
            position: relative;
        }
    </style>
    <div class="collapse navbar-collapse" id="navbar-categories">

        <ul class="navbar-nav flex-column">
            <li class="category-text">All Categories</li>
            <?php $category = SM::getProductCategories(); ?>
            @foreach($category as $category_list)
                {{--@if (count($category_list->products) > 0)--}}
                <?php $sub_category = SM::getProductsubCategories($category_list->id);?>

                <li class="nav-item dropdown">
                    <a href="{{url('/category/'.$category_list->slug)}}" class="nav-link dropdown-toggle">
                        <img class="img-fuild"
                             src="{!! SM::sm_get_the_src($category_list->image, 30,30) !!}"> {{$category_list->title}}
                        <?php if (count($sub_category) > 0) { ?>
                        <i class="fa fa-angle-right " aria-hidden="true"></i>
                        <?php } ?>
                    </a>

                    @if(count($sub_category)>0)
                        <ul class="dropdown-menu multi-level ">
                            @foreach($sub_category as $sub_categort_list)
                                @if (count($sub_categort_list->products) > 0)
                                    <?php $sub__sub_category = SM::getProductsubCategories($sub_categort_list->id); ?>
                                    <li class="dropdown-submenu">
                                        <a class="dropdown-item" tabindex="-1"
                                           href="{{url('/category/'.$sub_categort_list->slug)}}">
                                            {{$sub_categort_list->title}}
                                            <?php if (count($sub__sub_category) > 0) { ?>
                                            <i class="fa fa-angle-right " aria-hidden="true"></i>
                                            <?php } ?>
                                        </a>
                                        @if(count($sub__sub_category)>0)
                                            <ul class="dropdown-menu multi-level ">
                                                @foreach($sub__sub_category as $sub_sub_categort_list)
                                                    {{--                                                        @if (count($sub_sub_categort_list->products) > 0)--}}
                                                    <li class="dropdown-submenu">
                                                        <a class="dropdown-item" tabindex="-1"
                                                           href="{{url('/category/'.$sub_sub_categort_list->slug)}}">
                                                            {{$sub_sub_categort_list->title}}
                                                        </a>
                                                    </li>
                                                    {{--@endif--}}
                                                @endforeach
                                            </ul>
                                        @endif

                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </li>
                {{--@endif--}}
            @endforeach
        </ul>
    </div>
</nav>

 <?php
    $home_left_image_link = SM::smGetThemeOption("home_left_image_link", "#");
    $home_left_image = SM::smGetThemeOption("home_left_image");
    $home_left_image_enable = SM::smGetThemeOption("home_left_image_enable", 1);
     ?> 
 @if($home_left_image_enable==1)
@empty(!$home_left_image)
<div class="panel panel-default panel-extra hidden-sm hidden"> 
    <a href="{!! $home_left_image_link !!}" title="Fresh Vegetable">
        <div class="panel-body box-img">
                    <img src="{!! SM::sm_get_the_src( $home_left_image, 270,450 ) !!}"
                         alt="ads-banner" title="ads-banner"
                         style=" width: 100%;">
        </div>
    </a>
</div>
 @endempty
 @endif
