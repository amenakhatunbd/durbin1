<!DOCTYPE html>
<html>
  <head>
    @include('frontend.common.meta')
    @include('frontend.inc.css')
    @include('frontend.common.additional_css')
    @stack('style')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  </head>
  <body>
    @include('frontend.inc.header')
    @include('frontend.common.login_modal')
    @include('frontend.common.s_w_message')
    <div class="search-html">
      @yield('content')
    </div>
    @include('frontend.inc.footer')
    @include('frontend.common.additional_js')
    @include('frontend.inc.js')
    @stack('script')
  </body>

  <div id="fb-root"></div>
  <div id="fb-customer-chat" class="fb-customerchat">

  </div>
<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "893881954335385");
  chatbox.setAttribute("attribution", "biz_inbox");
  window.fbAsyncInit = function() {
      FB.init({
          xfbml: true,
          version: 'v10.0'
      });
  };

(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }
(document, 'script', 'facebook-jssdk'));

$('.Similar_Books_carousel').slick({
    dots: true,
    // autoplay: true,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    adaptiveHeight: true
});
</script>

<div id="loadingGif" style="display:none"></div>
<style>
#loadingGif {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  background: rgba(0,0,0,0.75) url({{asset('images/durbinloader.gif') }}) no-repeat center center;
  z-index: 10000;
}
</style>
<script type="text/javascript">
       $('form').submit(function(){
        $(this).find("button[type='submit']").prop('disabled',true);
            $('#loadingGif').show();
            //your client side validation here
            if(valid)
               return true;
            else
               {
                 $(this).removeAttr('disabled');
                 $('#loadingGif').hide();     
                 return false;
               }
        });
</script>
</html>