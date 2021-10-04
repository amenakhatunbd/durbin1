<?php
$product_best_sale_is_enable = SM::smGetThemeOption("product_best_sale_is_enable", 1);
$product_show_category = SM::smGetThemeOption("product_show_category", 1);
$product_show_tag = SM::smGetThemeOption("product_show_tag", 1);
$product_show_brand = SM::smGetThemeOption("product_show_brand", 1);
$product_show_size = SM::smGetThemeOption("product_show_size", 1);
$product_show_color = SM::smGetThemeOption("product_show_color", 1);
$product_detail_add = SM::smGetThemeOption("product_detail_add", 1);
?>
<style>
    li > ul > li > span:before {
        content: "\f0da";
        font-size: 14px;
        display: inline-block;
        text-align: right;
        color: #666;
        font-family: "FontAwesome";
        padding-right: 12px;
        color: #ccc;
    }
</style>
<div class="column col-xs-12 col-sm-3 col-md-2 p-0" id="left_column">

    <!-- block category -->
    @if($product_show_category==1)
        <?php
        $getMainCategories = SM::getProductCategories(0);
        ?>
        @if(count($getMainCategories)>0)
            <div class="block left-module">
                <p class="title_block">CATEGORIES</p>
                <div class="block_content content-cat-ex">
                    <!-- layered -->
                    <div class="layered layered-category">
                        <div class="layered-content">
                            <ul class="tree-menu">
                                @foreach($getMainCategories as $cat)
                                    <li class="active">
                                        <span></span>
                                        <a href="{!! url("category/".$cat->slug) !!}">{{$cat->title}}</a>
                                        <?php
                                        $getSubCategories = SM::getProductsubCategories($cat->id);
                                        ?>
                                        @empty(!$getSubCategories)
                                            <ul style="display: block;">
                                                @foreach($getSubCategories as $getSubCategory)
                                                    @if(count($getSubCategory->products)>0)
                                                        <li><span></span>
                                                            <a style="color: #ff3366;"
                                                               href="{!! url("category/".$getSubCategory->slug) !!}">{{ $getSubCategory->title }}</a>
                                                            <?php
                                                            $getSubSubCategories = SM::getProductsubCategories($getSubCategory->id);
                                                            ?>
                                                            @empty(!$getSubSubCategories)
                                                                <ul style="display: block;">
                                                                    @foreach($getSubSubCategories as $getSubSubCategory)
                                                                        <li><span></span>
                                                                            <a style="color: #ff3366;"
                                                                               href="{!! url("category/".$getSubSubCategory->slug) !!}">{{ $getSubSubCategory->title }}</a>

                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endempty
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @endempty
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- ./layered -->
                </div>
            </div>
        @endif
    @endif
<!-- ./block category  -->

    <?php
    $product_detail_add_link = SM::smGetThemeOption("product_detail_add_link", "#");
    $product_detail_add = SM::smGetThemeOption("product_detail_add");
    ?>
    @empty(!$product_detail_add)
        <div class="col-left-slide left-module">
            <div class="banner-opacity">
                <a href="{!! $product_detail_add_link !!}">
                    <img src="{!! SM::sm_get_the_src( $product_detail_add, 319,319 ) !!}" alt="ads-banner"
                         class="image-style"></a>
            </div>
        </div>
@endempty
<!--./left silde-->
</div>
<style>
    .content-cat-ex {
        padding: 0px -14px;
        height: 1000px;
        overflow-y: scroll;
    }
</style>