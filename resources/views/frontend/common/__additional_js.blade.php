<?php
$max_price = (int)\App\Model\Common\Product::max('regular_price');
$min_price = (int)\App\Model\Common\Product::min('regular_price');
?>
{!!Html::script('nptl-admin/js/plugin/jquery-validate/jquery.validate.min.js')!!}
{!!Html::script('https://unpkg.com/sweetalert/dist/sweetalert.min.js')!!}
{!!Html::script('additional/toastr/toastr.min.js')!!}
{{--blog section--}}
{!!Html::script('additional/js/swiper.jquery.min.js')!!}
{!!Html::script('additional/js/main.js')!!}
{!!Html::script('additional/js/nptl.js')!!}

{!! Toastr::message() !!}
<?php
SM::smGetSystemFrontEndJs([
//    "sm-validation",
////	"sm-validation.min",
//    "main",
//"main.min",
//    "doodle_digital",
//	"doodle_digital.min",
]);
?>
<script type="text/javascript">
    // ----currencyFormat---
    var currency = "<?php echo SM::get_currency_value(); ?>";

    function currencyFormat(num) {
        return currency + ' ' + num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

    // ----------toastr alert message--------------
    $(function () {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "1500",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
// ---------------coupon_check---------
        $('body').on('click', '.apply_coupon', function (event) {
            var coupon_code = $('#coupon_code').val();
            var sub_total_price = $('#sub_total_price').val();
            $.ajax({
                type: 'get',
                dataType: "json",
                url: '{{ URL::route('coupon_check')}}',
                data: {coupon_code: coupon_code, sub_total_price: sub_total_price},
                success: function (data) {
                    if (data.check_coupon == 1) {
                        $('.coupon_amount_val').html(currencyFormat(data.coupon_amount))
                        $('.grand_total_val').html(currencyFormat(data.grand_total))
                        $('.coupon_amount').val(data.coupon_amount)
                        $('.grand_total').val(data.grand_total)
                        $('.coupon_code').val(data.coupon_code)
                        toastr.success(data.message, data.title);
                    } else {
                        toastr.error(data.message, data.title);
                    }
                }
            });
        });
// ---------------ajax add to cart---------
       $('body').on('click', '.addToCart', function (event) {
            var product_id = $(this).data("product_id");
            var regular_price = $(this).data("regular_price");
            var sale_price = $(this).data("sale_price");
            var qty = $('.productCartQty').val();
            var product_attribute_color = $("input[name='product_attribute_color']:checked").val();
            var colorname = $("input[name='product_attribute_color']:checked").data("colorname");
            var product_attribute_size = $("input[name='product_attribute_size']:checked").val();
            var sizename = $("input[name='product_attribute_size']:checked").data("sizename");
            $.ajax({
                type: 'get',
                dataType: "json",
                url: '{{ URL::route('add_to_cart')}}',
                //                data: {product_id: product_id, regular_price: regular_price, sale_price: sale_price},
                data: {
                    product_id: product_id,
                    regular_price: regular_price,
                    sale_price: sale_price,
                    qty: qty,
                    product_attribute_size: product_attribute_size,
                    sizename: sizename,
                    product_attribute_color: product_attribute_color,
                    colorname: colorname
                },
                success: function (data) {
                    if (data.check_val == 1) {
                        $('.header_cart_html').html(data.header_cart_html);
                        $('.cart_icon').html(data.cart_icon);
                        $('.cart_icon_popup').html(data.cart_icon_pop);
                        $('.popup_top_total').html(data.popup_top_total);
                        $('.sub_total').html(data.sub_total);
                        //                        $('[data-product_id="' + product_id + '"]').parent('.add-to-cart').html('<button data-product_id="' + product_id + '" class="addToCart" title="Product is added">Product is added</button>');
                        toastr.success(data.message, data.title);
                    } else {
                        toastr.error(data.error_message, data.error_title);
                    }
                }
            });
        });
// -----------updateCart------
        $('body').on('click', '.updateToCart', function (event) {
            var row_id = $(this).data("row_id");
            var qty = $(this).data("qty");
            $.ajax({
                type: 'get',
                dataType: "json",
                url: '{{ URL::route('update_to_cart')}}',
                data: {row_id: row_id, qty: qty},
                success: function (data) {
                    if (data.check_val == 1) {
                        $('.header_cart_html').html(data.header_cart_html);
                        $('.cart_icon').html(data.cart_icon);
                        $('.cart_icon_popup').html(data.cart_icon_pop);
                        $('.popup_top_total').html(data.popup_top_total);
                        $('.sub_total').html(data.sub_total);
                        $('.cart_table').html(data.cart_table);
                        toastr.success(data.message, data.title);
                    } else {
                        toastr.error(data.message, data.title);
                    }
                }
            });
        });
        $('body').on('click', '.incDetail', function (event) {
            event.preventDefault();
            var x;
            var row_id = $(this).data("row_id");
            x = $('#' + row_id).val();
//            $(this).siblings('input').attr('value', ++x);
            var qty = x;
            $.ajax({
                type: 'get',
                dataType: "json",
                url: '{{ URL::route('update_to_cart')}}',
                data: {row_id: row_id, qty: qty},
                success: function (data) {
                    if (data.check_val == 1) {
                        $('.header_cart_html').html(data.header_cart_html);
                        $('.cart_icon').html(data.cart_icon);
                        $('.cart_icon_popup').html(data.cart_icon_pop);
                        $('.popup_top_total').html(data.popup_top_total);
                        $('.sub_total').html(data.sub_total);
                        $('.cart_table').html(data.cart_table);
                        toastr.success(data.message, data.title);
                    } else {
                        toastr.error(data.message, data.title);
                    }
                }
            });
        });
        $('body').on('click', '.decDetail', function (event) {
            event.preventDefault();
            var x;
            var row_id = $(this).data("row_id");
            x = $('#' + row_id).val();
            if (x > 1) {

                var row_id = $(this).data("row_id");
                var qty = x;
                $.ajax({
                    type: 'get',
                    dataType: "json",
                    url: '{{ URL::route('update_to_cart')}}',
                    data: {row_id: row_id, qty: qty},
                    success: function (data) {
                        if (data.check_val == 1) {
                            $('.header_cart_html').html(data.header_cart_html);
                            $('.cart_icon').html(data.cart_icon);
                            $('.cart_icon_popup').html(data.cart_icon_pop);
                            $('.popup_top_total').html(data.popup_top_total);
                            $('.sub_total').html(data.sub_total);
                            $('.cart_table').html(data.cart_table);
                            toastr.success(data.message, data.title);
                        } else {
                            toastr.error(data.message, data.title);
                        }
                    }
                });
            }
        });
        $('body').on('click', '.inc', function (event) {
            event.preventDefault();
            var x;
            var row_id = $(this).data("row_id");
            x = $('#' + row_id).val();
//            $(this).siblings('input').attr('value', ++x);
            var qty = ++x;
            $.ajax({
                type: 'get',
                dataType: "json",
                url: '{{ URL::route('update_to_cart')}}',
                data: {row_id: row_id, qty: qty},
                success: function (data) {
                    if (data.check_val == 1) {
                        $('.header_cart_html').html(data.header_cart_html);
                        $('.cart_icon').html(data.cart_icon);
                        $('.cart_icon_popup').html(data.cart_icon_pop);
                        $('.popup_top_total').html(data.popup_top_total);
                        $('.sub_total').html(data.sub_total);
                        $('.cart_table').html(data.cart_table);
                        toastr.success(data.message, data.title);
                    } else {
                        toastr.error(data.message, data.title);
                    }

                }
            });
        });
        $('body').on('click', '.dec', function (event) {
            event.preventDefault();
            var x;
            var row_id = $(this).data("row_id");
            x = $('#' + row_id).val();
            if (x > 1) {

                var row_id = $(this).data("row_id");
                var qty = --x;
                $.ajax({
                    type: 'get',
                    dataType: "json",
                    url: '{{ URL::route('update_to_cart')}}',
                    data: {row_id: row_id, qty: qty},
                    success: function (data) {
                        if (data.check_val == 1) {
                            $('.header_cart_html').html(data.header_cart_html);
                            $('.cart_icon').html(data.cart_icon);
                            $('.cart_icon_popup').html(data.cart_icon_pop);
                            $('.popup_top_total').html(data.popup_top_total);
                            $('.sub_total').html(data.sub_total);
                            $('.cart_table').html(data.cart_table);
                            toastr.success(data.message, data.title);
                        } else {
                            toastr.error(data.message, data.title);
                        }
                    }
                });
            }
        });

// -----------removeToCart-------------
        $('body').on('click', '.removeToCart', function (event) {
//             alert('ok');
            var product_id = $(this).data("product_id");
            $.ajax({
                type: 'get',
                dataType: "json",
                url: '{{ URL::route('remove_to_cart')}}',
                data: {product_id: product_id},
                success: function (data) {
                    $('.cart_table').html(data.cart_table);
                    $('.header_cart_html').html(data.header_cart_html);
                    $('.popup_top_total').html(data.popup_top_total);
                    $('.cart_icon').html(data.cart_icon);
                    $('.sub_total').html(data.sub_total);
                    $('[data-product_id="' + product_id + '"]').parents('.removeCartTrLi').addClass('hidden');
                    $('.cart_count').text(data.cart_count);
                    toastr.error(data.message, data.title);
                    // $('.compare_data').text(data.compare_count);
                    // toastr.success(data.message, data.title);

                }
            });
        });
// ---------------ajax add to compare---------
        $('body').on('click', '.addToCompare', function (event) {
            var product_id = $(this).data("product_id");
            $.ajax({
                type: 'get',
                dataType: "json",
                url: '{{ URL::route('add_to_compare')}}',
                data: {product_id: product_id},
                success: function (data) {
                    if (data.exists_compare == 1) {
                        toastr.error(data.error_message, data.error_title);
                    } else {
                        $('[data-product_id="' + product_id + '"]').parent('.quick-view').find('.addToCompare').addClass('red');
                        $('.compare_data').text(data.compare_count);
                        $('.compare_html').html(data.header_cart_html);
                        toastr.success(data.message, data.title);
                    }
                }
            });
        });
        $('body').on('click', '.removeToCompare', function (event) {
            var product_id = $(this).data("product_id");
            $.ajax({
                type: 'get',
                dataType: "json",
                url: '{{ URL::route('remove_to_compare')}}',
                data: {product_id: product_id},
                success: function (data) {
                    $('[data-product_id="' + product_id + '"]').parents('.compareRow').addClass('hidden');
                    $('.cart_compare').text(data.cart_compare);
                    $('.header_cart_html').html(data.header_cart_html);
                    toastr.error(data.message, data.title);


                }
            });
        });
// ---------------ajax add to Wishlist ---------
        $('body').on('click', '.addToWishlist', function (event) {
            var product_id = $(this).data("product_id");
            $.ajax({
                type: 'get',
                dataType: "json",
                url: '{{ URL::route('add_to_wishlist')}}',
                data: {product_id: product_id},
                success: function (data) {
                    if (data.check_wishlist == 1) {
                        toastr.error(data.error_message, data.error_title);
                    } else {
                        $('[data-product_id="' + product_id + '"]').parent('.quick-view').find('.addToWishlist').addClass('red');
                        // $('.compare_data').text(data.compare_count);
                        $('.header_cart_html').html(data.header_cart_html);
                        $('#wishlist-count').text(data.header_wish_toggol);
                        toastr.success(data.message, data.title);
                    }

                }
            });
        });
        $('body').on('click', '.removeToWishlist', function (event) {
            var wshlist_id = $(this).data("wshlist_id");
            $.ajax({
                type: 'get',
                dataType: "json",
                url: '{{ URL::route('remove_to_wishlist')}}',
                data: {wshlist_id: wshlist_id},
                success: function (data) {
                    $('[data-wshlist_id="' + wshlist_id + '"]').parents('.wishlistRow').addClass('hidden');
                    $('.list-wishlist-load').html(data.header_wish_html);
                    $('#wishlist-count').text(data.header_wish_toggol);
                    toastr.error(data.message, data.title);
                }
            });
        });
// ----------review-------------
// jQuery(document).ready(function () {
//     jQuery('.ajaxReviewSubmit').click(function (e) {
        $('body').on('click', '.ajaxReviewSubmit', function (e) {
            e.preventDefault();
            $.ajax({
                method: 'get',
                dataType: "json",
                url: "{{ url('add_to_review') }}",
                data: {
                    product_id: $('.product_id').val(),
                    rating: $('.ajaxReviewForm input:checked').val(),
                    description: $('.description').val(),
                },
                success: function (data) {
                    if (data.check_reviewAuth == 1) {
                        toastr.error(data.error_message, data.error_title);
                    } else {
                        toastr.success(data.message, data.title);
                        $(".ajaxReviewForm")[0].reset();
                    }
                    //                    toastr.success(data.message, data.title);

                }
            });
        });
// });

        $('body').on('click', '.removeToReview', function (event) {
            var review_id = $(this).data("review_id");
            $.ajax({
                type: 'get',
                dataType: "json",
                url: '{{ URL::route('remove_to_review')}}',
                data: {review_id: review_id},
                success: function (data) {
                    $('[data-review_id="' + review_id + '"]').parents('.reviewRow').addClass('hidden');
                    toastr.error(data.message, data.title);
                }
            });
        });
// ---------------------------

    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('input:checkbox').click(function () {
            $('input:checkbox').not(this).prop('checked', false);
        });
    });
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
            var brand = get_filter('brand');
            var category = get_filter('category');
            var size = get_filter('size');
            var color = get_filter('color');
            var onChangeProductFilter = $('.orderByPrice').val();
            var limitProduct = $('.limitProduct').val();
            $.ajax({
//            url: '{{ URL::route('product_search_data')}}',
                url: url,
                method: "get",
                data: {
                    action: action,
                    minimum_price: minimum_price,
                    maximum_price: maximum_price,
                    brand: brand,
                    category: category,
                    size: size,
                    color: color,
                    onChangeProductFilter: onChangeProductFilter,
                    limitProduct: limitProduct,
                },
                success: function (data) {
                    $('#ajax_view_product_list').html(data.product_filter_data);
                    $('#category_filter_data').html(data.category_filter_data);
                    $('#brand_filter_data').html(data.brand_filter_data);
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

        $('.orderByPrice').on('change', function () {
            url = '{{ URL::route('product_search_data')}}';
            filter_data(url);
        });
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

    $(document).ready(function () {
        $('body').on('click', '#main_search_pagination a', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            search_on_nptl_search(url)
        });
    });

    function search_on_nptl_search(url) {
        var search_text = $("#myInput").val();
        var _token = $('#table_csrf_token').val();
        $.ajax({
            url: url,
            type: 'post',
            data: {search_text: search_text, _token: _token},
            success: function (data) {
                $('.search-html').html(data);
                $('html, body').animate({scrollTop: 0}, 'slow');
            },
            error: function (errors) {
                var errorRes = errors.responseJSON.errors;
                $(".search-html").html('Write Something');
            }
        });
    }

    if ($("#myInput").length > 0) {
        $("#myInput").on("keyup", function () {
            url = '{{ URL::route('main_search')}}';
            search_on_nptl_search(url);
        });
        $("#myInput").on("change", function () {
            url = '{{ URL::route('main_search')}}';
            search_on_nptl_search(url);
        });
    }
    $('body').on('click', '.common_selector', function () {
        $(this).parents('.sub-cat').siblings('input').prop("checked", false);
    })


    $('.customDropDown').on('change', function () {
        $(this).parents("form").submit();
    })


    // Trigger CSS animations on scroll.
    jQuery(function ($) {

        // Function which adds the 'animated' class to any '.animatable' in view
        var doAnimations = function () {

            // Calc current offset and get all animatables
            var offset = $(window).scrollTop() + $(window).height(),
                $animatables = $('.animatable');

            // Unbind scroll handler if we have no animatables
            if ($animatables.length == 0) {
                $(window).off('scroll', doAnimations);
            }

            // Check all animatables and animate them if necessary
            $animatables.each(function (i) {
                var $animatable = $(this);
                if (($animatable.offset().top + $animatable.height() - 20) < offset) {
                    $animatable.removeClass('animatable').addClass('animated');
                }
            });

        };

        // Hook doAnimations on scroll, and trigger a scroll
        $(window).on('scroll', doAnimations);
        $(window).trigger('scroll');

    });


</script>








