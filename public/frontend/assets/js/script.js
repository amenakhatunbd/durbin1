// Dropdown Menu Fade    
$(document).scroll(function() {
  var y = $(this).scrollTop();
  if (y > 350) {
    $('.bottomMenu').fadeIn();
  } else {
    $('.bottomMenu').fadeOut();
  }
});
jQuery(document).ready(function(){

    $(".dropdown").hover(

        function() { $('.dropdown-menu', this).fadeIn("fast");

        },

        function() { $('.dropdown-menu', this).fadeOut("fast");

    });

});



$(function() {
    
    $( '#dl-menu' ).dlmenu({
		animationClasses : { classin : 'dl-animate-in-4', classout : 'dl-animate-out-4' }
	});
	
	

    $('#login-form-link').click(function(e) {
    $("#login-form").delay(100).fadeIn(100);
    $("#register-form").fadeOut(100);
    $('#register-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });
  $('#register-form-link').click(function(e) {
    $("#register-form").delay(100).fadeIn(100);
    $("#login-form").fadeOut(100);
    $('#login-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });

});
$('.banar-login').slick({
  dots: false,
  infinite: true,
  speed: 500,
  fade: true,
  arrows: false,
});
$('.carousel').carousel();
$('.recent-sold-slide-mamun').slick({

  dots: false,

  infinite: false,

  arrows:true,

  speed: 300,

  slidesToShow: 1,

  slidesToScroll: 1,

  responsive: [

    {

      breakpoint: 1024,

      settings: {

        slidesToShow: 2,

        slidesToScroll: 1,

        infinite: true,

        dots: true

      }

    },

    {

      breakpoint: 600,

      settings: {

        slidesToShow: 2,

        slidesToScroll: 2

      }

    },

    {

      breakpoint: 480,

      settings: {

        slidesToShow: 1,

        slidesToScroll: 1

      }

    }

    // You can unslick at a given breakpoint now by adding:

    // settings: "unslick"

    // instead of a settings object

  ]

});
$('.recent-sold-slide').slick({

  dots: false,

  infinite: false,

  arrows:true,

  speed: 300,

  slidesToShow: 6,

  slidesToScroll: 1,

  responsive: [

    {

      breakpoint: 1024,

      settings: {

        slidesToShow: 2,

        slidesToScroll: 1,

        infinite: true,

        dots: true

      }

    },

    {

      breakpoint: 600,

      settings: {

        slidesToShow: 2,

        slidesToScroll: 2

      }

    },

    {

      breakpoint: 480,

      settings: {

        slidesToShow: 1,

        slidesToScroll: 1

      }

    }

    // You can unslick at a given breakpoint now by adding:

    // settings: "unslick"

    // instead of a settings object

  ]

});

$('.all-sale-slide').slick({

  dots: false,

  infinite: false,

  arrows:true,

  speed: 300,

  slidesToShow: 6,

  slidesToScroll: 6,

  responsive: [

    {

      breakpoint: 1024,

      settings: {

        slidesToShow: 3,

        slidesToScroll: 3,

        infinite: true,

        dots: true

      }

    },

    {

      breakpoint: 600,

      settings: {

        slidesToShow: 2,

        slidesToScroll: 2

      }

    },

    {

      breakpoint: 480,

      settings: {

        slidesToShow: 1,

        slidesToScroll: 1

      }

    }

    // You can unslick at a given breakpoint now by adding:

    // settings: "unslick"

    // instead of a settings object

  ]

});





$('.author-pro-slide').slick({

  dots: false,

  infinite: false,

  arrows:true,

  speed: 300,

  slidesToShow: 6,

  slidesToScroll: 6,

  responsive: [

    {

      breakpoint: 1024,

      settings: {

        slidesToShow: 3,

        slidesToScroll: 3,

        infinite: true,

        dots: true

      }

    },

    {

      breakpoint: 600,

      settings: {

        slidesToShow: 2,

        slidesToScroll: 2

      }

    },

    {

      breakpoint: 480,

      settings: {

        slidesToShow: 1,

        slidesToScroll: 1

      }

    }

    // You can unslick at a given breakpoint now by adding:

    // settings: "unslick"

    // instead of a settings object

  ]

});

// ====================================


// change by nahid hassan mobile login section 

$(document).ready(function(){

    $(".dropdown").hover(            

        function() {

            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("400");

            $(this).toggleClass('open');        

        },

        function() {

            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("400");

            $(this).toggleClass('open');       

        }

    );

});







$(document).ready(function(){

  $(".read-more").click(function(){

    $(".read-more").hide();

    $("p").addClass("text-details");

  });

});

$(document).ready(function(){

  $(".read-more-comments").click(function(){

    $(".read-more-comments").hide();

    $(".read-less").show();

    $("p").addClass("comments-details");

    $(".read-less").addClass("less-show");

  });

  

  $(".read-less").click(function(){

    $(".read-less").hide();

    $(".read-more-comments").show();

    $("p").removeClass("comments-details");

    $(".read-less").addClass("less-show");

  });

});







// ===========================================

// $(document).ready(function(){

//   $(".read-more-comments").click(function(){

//     $(this).hide();

//     $(this).closest(".read-less").show();

//     $(this).closest("p").addClass("comments-details");

//     // $("p").addClass("comments-details");

//     // $(".read-less").addClass("less-show");

//   });

//   $(".read-less").click(function(){

//     $(".read-less").hide();

//     $(".read-more-comments").show();

//     $("p").removeClass("comments-details");

//     $(".read-less").addClass("less-show");

//   });

// });



// ================ Dedails page quantity box===============



function increaseValue() {

  var value = parseInt(document.getElementById('number').value, 10);

  value = isNaN(value) ? 0 : value;

  value++;

  document.getElementById('number').value = value;

}



function decreaseValue() {

  var value = parseInt(document.getElementById('number').value, 10);

  value = isNaN(value) ? 0 : value;

  value < 1 ? value = 1 : '';

  value--;

  document.getElementById('number').value = value;

}

// ==================================

$(document).ready(function(){

  $(".close-cart").on("click",function(){

    // alert('dhfjgdfgdfg');

    console.log($(this).parents());

    $(this).parents('tr').addClass('hidden-cart');

  });

});


// =======================================

// ==========================================

function openNav() {
  document.getElementById("mySidepanel").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidepanel").style.width = "0";
}



// =======================================

// ==========================================

var right = document.getElementsByClassName("right");

    var si = right.length;

    var z=1;

    turnRight();

    function turnRight()

    {

        if(si>=1){

            si--;

        }

        else{

            si=right.length-1;

            function sttmot(i){

                setTimeout(function(){right[i].style.zIndex="auto";},300);

            }

            for(var i=0;i<right.length;i++){

                right[i].className="right";

                sttmot(i);

                z=1;

            }

        }

        right[si].classList.add("flip");

        z++;

        right[si].style.zIndex=z;

    }

    function turnLeft()

    {

        if(si<right.length){

            si++;

        }

        else{

            si=1;

            for(var i=right.length-1;i>0;i--){

                right[i].classList.add("flip");

                right[i].style.zIndex=right.length+1-i;

            }

        }

        right[si-1].className="right";

        setTimeout(function(){right[si-1].style.zIndex="auto";},350);

    }

