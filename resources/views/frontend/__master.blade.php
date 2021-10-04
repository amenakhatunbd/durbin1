<html>
<head>
     @include('frontend.common.meta')
    @include('frontend.inc.css')
{{--    @include('frontend.common.additional_css')--}}
    @stack('style')
</head>
<body>
@include('frontend.inc.header')
@include('frontend.common.s_w_message')
@yield('content')
@include('frontend.inc.footer')
<!-- all js scripts including custom js -->
<!-- scripts -->
@include('frontend.inc.js')
{{--@include('frontend.common.additional_js')--}}
@stack('script')
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


</body>
</html>


