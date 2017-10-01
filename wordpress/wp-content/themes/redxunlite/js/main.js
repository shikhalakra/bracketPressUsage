// LET'S DANCE
jQuery(document).ready(function($){

// Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('.main-navigation').outerHeight();
$(window).scroll(function(event){
    didScroll = true;
});
setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 350);
function hasScrolled() {
  var st = $(this).scrollTop();
  if(Math.abs(lastScrollTop - st) <= delta)
      return;
  if (st > lastScrollTop && st > navbarHeight){
      $('.main-navigation').removeClass('nav-down swingInX').addClass('swingInX swingOutX');
  } else {
      if(st + $(window).height() < $(document).height()) {
          $('.main-navigation').removeClass('swingInX swingOutX').addClass('nav-down swingInX');
      }
  }
  lastScrollTop = st;
}

// fixed bottom nav for prev/next
var fixedrp = $('.fixedbottomnav');
if (fixedrp.length) {
  var topOfOthDiv = $('.site-header').offset().top;
  $('.wrapfixedbottomnav').css ("height", 80);
  $(window).scroll(function(){
    $(".fixedrp").css("opacity", 0);
    $('.fixedrp').css ("bottom", -78);
     $(window).scroll(function() {
         if($(window).scrollTop() > topOfOthDiv) {
            $(".fixedrp").css("opacity", 1);
            $('.fixedrp').css ("bottom", 0);
         }
     });
   });
   $( ".fbheader" ).click(function(e) {
   e.preventDefault;
   $(this).toggleClass ("toggle");
   $(".wrapfixedbottomnav").slideToggle();
   });
}


// smooth scroll when click anchor
var pagearrow = $('.article-cover__arrow');
if (pagearrow.length) {
$('a.sscroll').click(function(){
    $('html, body').animate({
        scrollTop: $( $.attr(this, 'href') ).offset().top - 40
    }, 800);
    return false;
});
}

// to top
$("a.sscroll[href='#totop']").click(function() {
  $("html, body").animate({ scrollTop: 0 }, "slow");
  return false;
});

// just jump
var jumptopageof = $('#jumptopageof');
  if (jumptopageof.length) {
    $(document.body).animate({
      'scrollTop':   $(jumptopageof).offset().top - 40
    }, 800);
  }


// Toggle mobile-menu
$(".nav-toggle").on("click", function(){
$(this).toggleClass("active");
$(".mobile-menu").slideToggle();
return false;
});

// Hide/show mobile menu block > 900
$(window).resize(function() {
	if ($(window).width() > 1000) {
		$(".toggle").removeClass("active");
		$(".mobile-menu").hide();
	}
});



// STOP DANCE
});
