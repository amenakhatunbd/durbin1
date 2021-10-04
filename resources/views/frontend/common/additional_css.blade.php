{!!Html::style('additional/dashboard/dashboard.css')!!}
{{--blog section--}}
{{--{!!Html::style('additional/css/blog.css')!!}--}}
{!!Html::style('additional/css/swiper.min.css')!!}
{!!Html::style('additional/toastr/toastr.min.css')!!}
{!!Html::style('additional/css/custom.css')!!}
{!!Html::style('additional/moblie_menu/css/default.css')!!}
{!!Html::style('additional/moblie_menu/css/component.css')!!}
{!!Html::script('additional/moblie_menu/js/modernizr.custom.js')!!}


<?php
SM::smGetSystemFrontEndCss([
//        "style",
//		"style.min",
    "responsive",
//		"responsive.min",
]);
SM::smGetSystemFrontEndJs([
    "jquery-3.2.1.min",
    "state"
]);
?>
{{--{!!Html::style('additional/dashboard/state.js')!!}--}}
<style>
    {{--Buttons minus and plus in input--}}
    input,
    textarea {
        border: 1px solid #eeeeee;
        box-sizing: border-box;
        margin: 0;
        outline: none;
        padding: 10px;
    }

    input[type="button"] {
        -webkit-appearance: button;
        cursor: pointer;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }


    .input-group input[type='button'] {
        background-color: #eeeeee;
        min-width: 30px;
        width: auto;
        transition: all 300ms ease;
    }

    .input-group .button-minus,
    .input-group .button-plus {
        font-weight: bold;
        height: 30px;
        padding: 0;
        width: 30px;
        position: relative;
    }

    .input-group .quantity-field {
        position: relative;
        height: 30px;
        left: -6px;
        text-align: center;
        width: 62px;
        display: inline-block;
        font-size: 13px;
        margin: 0 0 5px;
        resize: vertical;
    }

    .button-plus {
        left: -13px;
    }

    input[type="number"] {
        -moz-appearance: textfield;
        -webkit-appearance: none;
    }

    /*Buttons minus and plus in input*/
    /*requiredStar*/
    .requiredStar:after {
        color: #d00;
        content: "*";
        margin-left: 5px;
        font-weight: bold;
    }

    #main-menu .dropdown-menu.container-fluid {
        padding: 15px 17px;
    }

    .dropdown-menu > li > a {
        display: block;
        padding: 5px 2px;
        clear: both;
        font-weight: 400;
        line-height: 1.42857143;
        color: #333;
        white-space: nowrap;
    }

    .option5 .product-list li .quick-view a.red {
        background: #fa110d;
    }

    #loading {
        background: url(../additional/images/loader.gif) no-repeat;
        /*background: url(../images/loader.gif) no-repeat;*/
        width: 80px;
        height: 80px;
        background-size: 80px 80px;
        left: 46%;
        top: 46%;
        z-index: 9999;
        position: fixed;

    }

    /*#loader {*/
    /*background: url(../frontend/images/loader/loader.gif) no-repeat;*/
    /*width: 80px;*/
    /*height: 80px;*/
    /*background-size: 80px 80px;*/
    /*position: fixed;*/
    /*left: 46%;*/
    /*top: 46%;*/
    /*z-index: 9999;*/
    /*}*/
    .error-notice {
        font-size: 13px;
        color: #ff0000;
        margin-top: 10px;
        display: block;
        font-style: italic;
        padding-left: 20px;
        line-height: 1.2;
    }

    .success-notice {
        font-size: 13px;
        color: #008000;
        margin-top: 10px;
        display: block;
        font-style: italic;
        padding-left: 20px;
        line-height: 1.2;
    }

    /*-----------*/
    /*--------- login socail ------*/
    .social-btn .btn {
        border: none;
        margin: 10px 3px 0;
        opacity: 1;
    }

    .social-btn .btn:hover {
        opacity: 0.9;
    }

    .social-btn .btn-primary {
        background: #507cc0;
    }

    .social-btn .btn-info {
        background: #64ccf1;
    }

    .social-btn .btn-danger {
        background: #df4930;
    }

    .or-seperator {
        margin-top: 20px;
        text-align: center;
        border-top: 1px solid #ccc;
    }

    .or-seperator i {
        padding: 0 10px;
        background: #f7f7f7;
        position: relative;
        top: -11px;
        z-index: 1;
    }

    .login-socail-form {
        margin: 0px 0 0px;
    }

    .login-socail-form .or {
        display: block;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        text-align: center;
        margin: auto;
        background: #5165a3;
        color: #FFFFFF;
        font-weight: 700;
        font-size: 18px;
        padding: 14px 0;
        margin-bottom: 30px;
    }

    .login-socail-form ul {
        padding: 0;
        text-align: center;
    }

    .login-socail-form ul li {
        display: table-cell;
        list-style: none;
        border-radius: 25px;
        text-align: left;
        background: #000;
        margin: 0 6px;
        transition: all ease 500ms;
        position: relative;
    }

    .login-socail-form ul li a {
        color: #FFFFFF;
        font-size: 14px;
        font-weight: 600;
        text-align: left;
        transition: all ease 500ms;
        display: block;
    }

    .login-socail-form ul li span {
        transform: scale(0);
        opacity: 0;
        transition: all ease 500ms;
        position: absolute;
        font-size: 14px;
        font-weight: 600;
        z-index: 1;
        right: 12px;
        top: 11px;
    }

    .login-socail-form ul li:hover span {
        transform: scale(1);
        color: #FFFFFF;
        opacity: 1;
    }

    .login-socail-form ul li.face {
        background: #3b5998;
    }


    .login-socail-form ul li.goo {
        background: #DD5044;
    }


    .login-socail-form ul li.twi {
        background: #1DA1F2;
        padding: 10px 12px;
    }


    .login-socail-form ul li.lin {
        background: #0077b5;
        padding: 10px 12px;
    }
</style>
<?php $method = strtolower(SM::current_method()); ?>
<script type="text/javascript">
    var url = '<?php echo url('') . '/'; ?>';
    var method = '<?php echo $method; ?>';
    var segment_active = '<?php echo Request::segment(2) ?>';
</script>
{!! SM::smGetThemeOption( "google_analytic_code"); !!}

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-145278129-1"></script>
<!-- Load Facebook SDK for JavaScript -->
<script>
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>


<section class="chat-box-area">
    <script>
        window.fbAsyncInit = function () {
            FB.init({
                appId: '312088412769976',
                autoLogAppEvents: false,
                xfbml: false,
                version: 'v2.12'
            });
        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <div class="fb-customerchat" page_id="407901929999387" minimized="true" theme_color="#b11b21"></div>
</section>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-145278129-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-145278129-1');
</script>
<!-- Facebook Pixel Code -->
<script>
    !function (f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function () {
            n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '595476274605033');
    fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
               src="https://www.facebook.com/tr?id=595476274605033&ev=PageView&noscript=1"
    /></noscript>
<!-- End Facebook Pixel Code -->