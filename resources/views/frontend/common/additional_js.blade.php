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
{!!Html::script('additional/moblie_menu/js/jquery.dlmenu.js')!!}
{!!Html::script('https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js')!!}

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
        
        {{--// ---------------quick view product -----------}}
        {{--$('body').on('click', '.quickViwe', function (event) {--}}
        {{--var product_slug = $(this).data("product_slug");--}}
        {{--$.ajax({--}}
        {{--type: 'get',--}}
        {{--dataType: "json",--}}
        {{--url: '{{ URL::route('productDetailQuick_view')}}',--}}
        {{--data: {--}}
        {{--product_slug: product_slug,--}}
        {{--},--}}
        {{--success: function (data) {--}}
        {{--$('.quickViwe_html').html(data.html);--}}
        {{--$('.quickViwe_title').html(data.title);--}}
        {{--}--}}
        {{--});--}}
        {{--});--}}
        // ---------------ajax add to cart---------
        $('body').on('click', '.overlay_mamun', function (event) {
          var slug =$(this).data("slug");
          var route_url = '{{ url('book')}}'+'/'+slug.trim();
          window.location.href = route_url;
       });
        
        $('body').on('click', '.addToCart', function (event) {
            
            var parent = $(this);
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
                        $('.cart_count').text(data.cart_count);
                        $('.cart_item_count').text(data.cart_item_count);
                        $(parent.closest('.custom-heart-extra')).html(data.added_success);
                        //                        $('[data-product_id="' + product_id + '"]').parent('.add-to-cart').html('<button data-product_id="' + product_id + '" class="addToCart" title="Product is added">Product is added</button>');
                        toastr.success(data.title);
                    } else {
                        toastr.error(data.title);
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
                        $('.cart_count').text(data.cart_count);
                        toastr.success(data.title);
                    } else {
                        toastr.error(data.title);
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
                        $('.cart_count').text(data.cart_count);
                        toastr.success(data.title);
                    } else {
                        toastr.error(data.title);
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
                            $('.cart_count').text(data.cart_count);
                            toastr.success(data.title);
                        } else {
                            toastr.error(data.title);
                        }
                    }
                });
            }
        });
        $('body').on('click', '.inc', function (event) {
            var parent = $(this);
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
                        $('.cart_count').text(data.cart_count);
                        $('.cart_item_count').text(data.cart_item_count);
                        $(parent.closest('.custom-heart-extra')).html(data.added_success);
                        toastr.success(data.title);
                    } else {
                        toastr.error(data.title);
                    }

                }
            });
        });
        $('body').on('click', '.dec', function (event) {
            var parent = $(this);
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
                            $('.cart_count').text(data.cart_count);
                            $('.cart_item_count').text(data.cart_item_count);
                            $(parent.closest('.custom-heart-extra')).html(data.added_success);
                            toastr.success(data.title);
                        } else {
                            toastr.error(data.title);
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
                    $('.cart_item_count').text(data.cart_item_count);
                    $('[data-product_id="' + product_id + '"]').parents('.removeCartTrLi').addClass('hidden');
                    $('.cart_count').text(data.cart_count);
                    toastr.error(data.title);
                    // $('.compare_data').text(data.compare_count);
                    // toastr.success(data.title);

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
                        toastr.error(data.title);
                    } else {
                        $('[data-product_id="' + product_id + '"]').parent('.quick-view').find('.addToCompare').addClass('red');
                        $('.compare_count').text(data.compare_count);
                        // $('.compare_html').html(data.header_cart_html);
                        toastr.success(data.title);
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
                    $('.compare_count').text(data.compare_count);
                    // $('.header_cart_html').html(data.header_cart_html);
                    toastr.error(data.title);
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
                        toastr.error(data.title);
                    } else {
                        $('[data-product_id="' + product_id + '"]').parent('.quick-view').find('.addToWishlist').addClass('red');
                        $('.wishlist_count').text(data.wishlist_count);
                        // $('.header_cart_html').html(data.header_cart_html);
                        // $('#wishlist-count').text(data.header_wish_toggol);
                        toastr.success(data.title);
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
                    // $('.list-wishlist-load').html(data.header_wish_html);
                    // $('#wishlist-count').text(data.header_wish_toggol);
                    $('.wishlist_count').text(data.wishlist_count);
                    toastr.error(data.title);
                }
            });
        });
// ----------review-------------
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
                        toastr.error(data.title);
                    } else {
                        toastr.success(data.title);
                        $(".ajaxReviewForm")[0].reset();
                    }
                }
            });
        });
        $('body').on('click', '.removeToReview', function (event) {
            var review_id = $(this).data("review_id");
            $.ajax({
                type: 'get',
                dataType: "json",
                url: '{{ URL::route('remove_to_review')}}',
                data: {review_id: review_id},
                success: function (data) {
                    $('[data-review_id="' + review_id + '"]').parents('.reviewRow').addClass('hidden');
                    toastr.error(data.title);
                }
            });
        });
// ---------------------------

    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('body').on('click', '#main_search_pagination a', function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            search_on_nptl_search(url)
        });
    });

    function search_on_nptl_search(url) {
        var search_text = $("#searchProduct").val();
        $.ajax({
            url: url,
            type: 'get',
            data: {search_text: search_text},
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

    if ($("#searchProduct").length > 0) {
        $("#searchProduct").on("keyup", function () {
            url = '{{ URL::route('main_search')}}';
            search_on_nptl_search(url);
        });
        $("#searchProduct").on("change", function () {
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






