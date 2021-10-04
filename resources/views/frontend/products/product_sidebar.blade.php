<?php
$product_special_is_enable = SM::smGetThemeOption("product_special_is_enable", 1);
$product_show_category = SM::smGetThemeOption("product_show_category", 1);
$product_show_tag = SM::smGetThemeOption("product_show_tag", 1);
$product_show_publisher = SM::smGetThemeOption("product_show_publisher", 1);
$product_show_author = SM::smGetThemeOption("product_show_author", 1);
$product_show_size = SM::smGetThemeOption("product_show_size", 1);
$product_show_color = SM::smGetThemeOption("product_show_color", 1);
$product_show_testimonial = SM::smGetThemeOption("product_show_testimonial", 1);
$product_show_advertisement = SM::smGetThemeOption("product_show_advertisement", 1);
?>
<div class="col-md-3">
    <!-- <div class="sidebar-wedget wow fadeInUp">
        <div class="title-box">
            <h3><i class="fa fa-toggle-on" aria-hidden="true"></i> Sort
                <a href="" class="pull-right hidden">Reset</a></h3>
        </div>
        <div class="sort-check-box">
            <label class="checkbox">Best Seller2
                <input type="radio" name="radio"
                       checked="" class="common_selector onChangeProductFilter"
                       value="3">
                <span class="checkmark"></span>
            </label>
            <label class="checkbox">New Released
                <input type="radio" name="radio" class="common_selector onChangeProductFilter" value="2">
                <span class="checkmark"></span>
            </label>
            <label class="checkbox">Product Name
                <input type="radio" name="radio" class="common_selector onChangeProductFilter" value="1">
                <span class="checkmark"></span>
            </label>
            <label class="checkbox">Price - Low to High
                <input type="radio" name="radio" class="common_selector onChangeProductFilter" value="5">
                <span class="checkmark"></span>
            </label>
            <label class="checkbox">Price - High to Low
                <input type="radio" name="radio" class="common_selector onChangeProductFilter" value="6">
                <span class="checkmark"></span>
            </label>
            <label class="checkbox">Discount
                <input type="radio" name="radio" class="common_selector onChangeProductFilter" value="7">
                <span class="checkmark"></span>
            </label>
        </div>
    </div> -->
    <!-- ----------------------------- -->
    @if($product_show_category==1)
        <?php
        $getProductCategories = SM::getProductCategories(0);
        ?>
        @if(count($getProductCategories)>0)
            <div class="sidebar-wedget wow fadeInUp">
                <div class="title-box">
                    <h3><i class="fa fa-filter" aria-hidden="true"></i> Filter
                        <a href="" class="pull-right hidden">Clear
                            All</a></h3>
                </div>
                <div class="search-box hidden">
                    <input type="text" name="" placeholder="Categoris" class="form-control">
                </div>
                <div class="fil-sort-check-box">
                    @foreach($getProductCategories as $cat)
                        <?php
                        $segment = Request::segment(2);
                        if ($segment == $cat->slug) {
                            $selected = 'checked';
                        } else {
                            $selected = '';
                        }
                        ?>
                        <label class="fil-check" for="c1_{{ $cat->id }}">{{$cat->title}}
                            <input {{ $selected }} type="checkbox" id="c1_{{ $cat->id }}"
                                   value="{{ $cat->id }}" class="common_selector category"/>
                            <span class="checkmark"></span>
                        </label>
                        <?php
                        echo SM::category_tree_for_select_cat_id($cat->id, $segment);
                        ?>
                    @endforeach
                </div>
            </div>
        @endif
    @endif

<!-- ------------------ -->
    @if($product_show_author==1)
        <?php
        $getProductAuthors = SM::getProductAuthors(0);
        ?>
        @if(count($getProductAuthors)>0)
            <div class="sidebar-wedget wow fadeInUp">
                <div class="title-box">
                    <h3><i class="fa fa-filter" aria-hidden="true"></i> Authors
                        <a href="" class="pull-right hidden">Clear All</a>
                    </h3>
                </div>
                <div class="search-box hidden">
                    <input type="text" name="" placeholder="Author" class="form-control">
                </div>
                <div class="fil-sort-check-box">
                    @foreach($getProductAuthors as $author)
                 
                    <?php
                        $segment2 = Request::segment(2);
                        if ($segment2 == $author->slug) {
                            $selected2 = 'checked';
                        } else {
                            $selected2 = '';
                        }
                        ?>
                        <label class="fil-check" for="author_{{ $author->id }}">{{ $author->title }}
                            <input {{ $selected2 }} type="checkbox" value="{{ $author->id }}"
                                   id="author_{{ $author->id }}"
                                   class="common_selector author"/>
                            <span class="checkmark"></span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
    @if($product_show_publisher==1)
        <?php
        $getProductPublishers = SM::getProductPublishers(0);
        ?>
        @if(count($getProductPublishers)>0)
            <div class="sidebar-wedget wow fadeInUp">
                <div class="title-box">
                    <h3><i class="fa fa-filter" aria-hidden="true"></i> Publishers
                        <a href="" class="pull-right hidden">Clear All</a>
                    </h3>
                </div>
                <div class="search-box hidden">
                    <input type="text" name="" placeholder="Publishers" class="form-control">
                </div>
                <div class="fil-sort-check-box">
                    @foreach($getProductPublishers as $publisher)
                        <?php
                        $segment2 = Request::segment(2);
                        if ($segment2 == $publisher->slug) {
                            $selected2 = 'checked';
                        } else {
                            $selected2 = '';
                        }
                        ?>
                        <label class="fil-check" for="publisher_{{ $publisher->id }}">{{ $publisher->title }}
                            <input {{ $selected2 }} type="checkbox" value="{{ $publisher->id }}"
                                   id="publisher_{{ $publisher->id }}"
                                   class="common_selector publisher"/>
                            <span class="checkmark"></span>
                        </label>
                    @endforeach
                </div>
            </div>
    @endif
@endif
<!-- ----------------- -->
    <div class="sidebar-wedget hidden wow fadeInUp">
        <div class="title-box">
            <h3> Rattings</h3>
        </div>
        <div class="sort-check-box">
            <label class="fil-check"> <i class="fa fa-star"></i>
                <input type="checkbox">
                <span class="checkmark"></span>
            </label>
            <label class="fil-check"><i class="fa fa-star"></i> <i class="fa fa-star"></i>
                <input type="checkbox">
                <span class="checkmark"></span>
            </label>
            <label class="fil-check"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                        class="fa fa-star"></i>
                <input type="checkbox">
                <span class="checkmark"></span>
            </label>
            <label class="fil-check"><i class="fa fa-star"></i> <i class="fa fa-star"></i><i class="fa fa-star"></i><i
                        class="fa fa-star"></i>
                <input type="checkbox">
                <span class="checkmark"></span>
            </label>
            <label class="fil-check"><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                        class="fa fa-star"></i><i
                        class="fa fa-star"></i><i class="fa fa-star"></i>
                <input type="checkbox">
                <span class="checkmark"></span>
            </label>

        </div>
    </div>
</div>
<script>
    // $(document).ready(function () {
    //     $('input:checkbox').click(function () {
    //         $('input:checkbox').not(this).prop('checked', false);
    //     });
    // });
  
    
    $(document).ready(function () {
        url = '{{ URL::route('product_search_data')}}';
        filter_data(url);
        $('body').on('click', '#shop_search_pagination a', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            filter_data(url)
        });

        function filter_data(url) {
            $('#ajax_view_product_list').html('<div id="loading"></div>');
            var action = 'fetch_data';
            var minimum_price = $('#hidden_minimum_price').val();
            var maximum_price = $('#hidden_maximum_price').val();
            var type = $('#get_type').val();
            var author = get_filter('author');
            var publisher = get_filter('publisher');
            var category = get_filter('category');
            var size = get_filter('size');
            var color = get_filter('color');
            var onChangeProductFilter = get_filter('onChangeProductFilter');
            // var onChangeProductFilter = $('.onChangeProductFilter').val();
            var limitProduct = $('.limitProduct').val();
            $.ajax({
//            url: '{{ URL::route('product_search_data')}}',
                url: url,
                method: "get",
                data: {
                    action: action,
                    minimum_price: minimum_price,
                    maximum_price: maximum_price,
                    type: type,
                    author: author,
                    publisher: publisher,
                    category: category,
                    size: size,
                    color: color,
                    onChangeProductFilter:1,// onChangeProductFilter,
                    limitProduct: limitProduct,
                },
                success: function (data) {
                    $('#ajax_view_product_list').html(data.product_filter_data);
                    $('#category_filter_data').html(data.category_filter_data);
                    $('#publisher_filter_data').html(data.publisher_filter_data);
                    $('html, body').animate({scrollTop: 0}, 'slow');
                    $('.sp-wrap').smoothproducts();
                }
            });
        }

        function get_filter(class_name) {
            var filter = [];
            $('.' + class_name + ':checked').each(function () {
                filter.push($(this).val());
            });
            return filter;
        }

        $('.common_selector').click(function () {
            url = '{{ URL::route('product_search_data')}}';
            filter_data(url);
        });

        {{--$('.onChangeProductFilter').on('click', function () {--}}
        {{--    url = '{{ URL::route('product_search_data')}}';--}}
        {{--    filter_data(url);--}}
        {{--});--}}
        //        $('.common_selector').on('change', function () {
        //            var orderByPrice = $('.orderByPrice').val();
        //            var limitProduct = $('.limitProduct').val();
        //            url = '{{ URL::route('product_search_data')}}';
//            filter_data(url);
//        });
        $('.slider-range-price').slider({
            range: true,
            min: <?php echo(isset($min_price) ? $min_price : 0); ?>,
            max: <?php echo(isset($max_price) ? $max_price : 10); ?>,
            values: [<?php echo(isset($min_price) ? $min_price : 0); ?>,<?php echo(isset($max_price) ? $max_price : 10); ?>],
            step: 100,
            stop: function (event, ui) {
                $('.amount-range-price').html(ui.values[0] + ' - ' + ui.values[1]);
                $('#hidden_minimum_price').val(ui.values[0]);
                $('#hidden_maximum_price').val(ui.values[1]);
                url = '{{ URL::route('product_search_data')}}';
                filter_data(url);
            }
        });
    });
</script>
