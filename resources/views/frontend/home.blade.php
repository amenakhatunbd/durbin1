@extends('frontend.master')
@section('title', '')
@section('content')
    <!-- ---------------------------- -->
    @include('frontend.common.slider')
    @include('frontend.common.getBestSaleProduct', ['products' =>SM::getBestSaleProduct(), 'title'=>'Recently Sold Products', 'class'=>'recent-sold-intem-box', 'view_all'=>'View All', 'view_all_link'=>'/shop'])
    @include('frontend.common.slider_bottom')
    @include('frontend.common.featured_categories')


    @foreach($is_home_page_categories as $is_home_page_category)
        
        @php $slug = isset($is_home_page_category->slug) ? $is_home_page_category->slug : '' ; @endphp
        @include('frontend.common.getBestSaleProduct', ['products' =>SM::getBestSaleProductByCategory($is_home_page_category->slug), 'title'=>$is_home_page_category->title, 'class'=>'all-sell-intem-box', 'view_all'=>'View All', 'view_all_link'=>'/category/'.$slug])
    @endforeach
    @include('frontend.common.getBestSaleProduct', ['products' =>SM::getBestSaleProductWeek(), 'title'=>'গত সপ্তাহের বেস্টসেলার ২০টি পণ্য', 'class'=>'all-sell-intem-box', 'view_all'=>'View All', 'view_all_link'=>'/shop'])
    <?php
    $middle_left_add = SM::smGetThemeOption("middle_left_add");
    $middle_right_add = SM::smGetThemeOption("middle_right_add");
    ?>
    @if(!empty($middle_left_add) || !empty($middle_right_add))
        <section class="top-ads-section pad-top-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="top-ads-box">
                            <a href="">
                                <img alt="{{ SM::sm_get_site_name() }}"
                                     src="{!! SM::sm_get_the_src($middle_left_add, 555,275) !!}" class="img-responsive">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="top-ads-box">
                            <a href="">
                                <img alt="{{ SM::sm_get_site_name() }}"
                                     src="{!! SM::sm_get_the_src($middle_right_add, 555,275) !!}"
                                     class="img-responsive">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    @include('frontend.common.getBestSaleProduct', ['products' =>SM::getSpecialProduct(), 'title'=>'অতিরিক্ত ছাড়ের বই', 'class'=>'all-sell-intem-box', 'view_all'=>'View All', 'view_all_link'=>'/shop'])

    @include('frontend.common.top_rated_author')
    @include('frontend.common.footer_top')
    @include('frontend.common.getBestSaleProduct', ['products' =>SM::getNewestProduct(), 'title'=>'Recent Viewed Book'])
@endsection