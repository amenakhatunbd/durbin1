<?php
$home_add_is_enable = SM::smGetThemeOption("home_add_enable", 1);
$middle_left_add_link = SM::smGetThemeOption("middle_left_add_link", "#");
$middle_right_add_link = SM::smGetThemeOption("middle_right_add_link", "#");
$middle_left_add = SM::smGetThemeOption("middle_left_add");
$middle_right_add = SM::smGetThemeOption("middle_right_add");
?>
@if($home_add_is_enable==1)
    @if(!empty($middle_left_add) && !empty($middle_right_add))
        <section class="add-content animatable moveUp">
            <!----Banner Ads--------->
            {{--<div class="container">--}}
            <div class="row products-add-area">
                @empty(!$middle_left_add)
                    <div class="col-12 col-sm-6">
                        <div class="banner-image box-banner  p-0">
                            <a title="Banner Image" class="pic" href="{!! $middle_left_add_link !!}">
                                <img class="img-fluid" src="{!! SM::sm_get_the_src( $middle_left_add, 540,180 ) !!}"
                                     alt="ads-banner"></a>
                        </div>
                    </div>
                @endempty
                @empty(!$middle_right_add)
                    <div class="col-12 col-sm-6">
                        <div class="banner-image box-banner  p-0">
                            <a title="Banner Image" class="pic" href="{!! $middle_right_add_link !!}">
                                <img class="img-fluid" src="{!! SM::sm_get_the_src( $middle_right_add, 540,180 ) !!}"
                                     alt="ads-banner"></a>
                        </div>
                    </div>
                @endempty
            </div>
        {{--</div>--}}
        <!----Banner Ads--------->
        </section>
    @endif
@endif
