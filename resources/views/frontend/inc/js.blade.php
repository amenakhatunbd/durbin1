{!!Html::script('frontend/assets/js/jquery.min.js')!!}
{!!Html::script('frontend/assets/js/typed.js')!!}
{!!Html::script('frontend/assets/js/zeynep.js')!!}
{!!Html::script('frontend/assets/js/jquery.sticky.js')!!}
{!!Html::script('frontend/assets/js/popper.min.js')!!}
{!!Html::script('frontend/assets/js/bootstrap.min.js')!!}
{!!Html::script('frontend/assets/js/owl.carousel.min.js')!!}
{!!Html::script('frontend/assets/js/script.js')!!}



<script>hljs.initHighlightingOnLoad();</script>
<script type="text/javascript">

  $(window).load(function() {
    $(".loader").delay(2000).fadeOut("slow");
    $("#overlayer").delay(2000).fadeOut("slow");
  })

//  new Typed('#searchProduct', {
//     strings: ['Search By Book (Ex.মিসির আলি সমগ্র , Think And Grow Rich)', 'Search By Author (Ex. কিঙ্কর আহসান, Brain Tracy) ', 'Search By Publisher (Ex. শিখা প্রকাশনী, Pocket Books  )'],
//     typeSpeed: 0,
//     backSpeed: 0,
//     attr: 'placeholder',
//     bindInputFocusEvents: true,
//     loop: true
//   });


  new WOW().init();
  $(window).load(function(){
    $("#stcky-header").sticky({ topSpacing: 0 });
  });

$(function(){

  $(".form-control").typed({
    strings: ["Web Developer", "Graphic Designer", "Mobile Developer", "Road Warrior", "DevOps", "Real Estate Agent", "Accountant", "Product Manager", "CEO"],
    attr: "placeholder",
    typeSpeed: 100
  });

});

</script>

