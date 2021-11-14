/* ====================================================================================================================
  Javascript Document
  Author: Jean Cuadros
/* ===================================================================================================================*/

(function($) {
  "use strict"; // Start of use strict

  // Smooth scrolling using jQuery easing
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: (target.offset().top - 70)
        }, 1000, "easeInOutExpo");
        return false;
      }
    }
  });
  // Activate scrollspy to add active class to navbar items on scroll
  $('#page-top').scrollspy({
    target: '#mainNav',
    offset: 80
  });
  // Closes responsive menu when a scroll trigger link is clicked
  $('.js-scroll-trigger').click(function () {
    $('.navbar-collapse').collapse('hide');
  });
  // Collapse Navbar Animation
  var navbarCollapse = function () {
    if ($("#mainNav").offset().top > 100) {
      $("#mainNav").addClass("navbar-animation");
    } else {
      $("#mainNav").removeClass("navbar-animation");
    }
  };
  navbarCollapse();
  $(window).scroll(navbarCollapse);

  // Scroll to top button appear
  $(document).scroll(function () {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Scroll change Color
  $(document).ready(function () {
    $(window).scroll(function () {
      var y = $(this).scrollTop();
      var mainNav = $('#mainNav').offset().top;
      var about = $('#about').offset().top;
      var gallery = $('#gallery').offset().top;
      var contact = $('#contact').offset().top;

      var mainNav = mainNav - 86;
      var about = about - 86;
      var gallery = gallery - 86;
      var contact = contact - 86;

      if (y >= mainNav) {
        $('#mainNav').css('background-color','#36A8E0');
        $('.t-rs-fb').css('background-image','url(img/icon/face-azul.png)');
        $('.t-rs-in').css('background-image','url(img/icon/insta-azul.png)');
        $('.t-rs-wa').css('background-image','url(img/icon/whatsapp-azul.png)');
        $('.t-rs-yt').css('background-image','url(img/icon/youtube-azul.png)');
      }
      if (y >= about) {
        $('#mainNav').css('background-color','#A139B0');
        $('.t-rs-fb').css('background-image','url(img/icon/face-morado.png)');
        $('.t-rs-in').css('background-image','url(img/icon/insta-morado.png)');
        $('.t-rs-wa').css('background-image','url(img/icon/whatsapp-morado.png)');
        $('.t-rs-yt').css('background-image','url(img/icon/youtube-morado.png)');
      }
      if (y >= gallery) {
        $('#mainNav').css('background-color','#36A8E0');
        $('.t-rs-fb').css('background-image','url(img/icon/face-azul.png)');
        $('.t-rs-in').css('background-image','url(img/icon/insta-azul.png)');
        $('.t-rs-wa').css('background-image','url(img/icon/whatsapp-azul.png)');
        $('.t-rs-yt').css('background-image','url(img/icon/youtube-azul.png)');
      }
      if (y >= contact) {
        $('#mainNav').css('background-color','#A139B0');
        $('.t-rs-fb').css('background-image','url(img/icon/face-morado.png)');
        $('.t-rs-in').css('background-image','url(img/icon/insta-morado.png)');
        $('.t-rs-wa').css('background-image','url(img/icon/whatsapp-morado.png)');
        $('.t-rs-yt').css('background-image','url(img/icon/youtube-morado.png)');
      }
    });
  });

/* ====================================================================================================================
* WOW ANIMATION
* ====================================================================================================================*/
  new WOW().init();
  /* ====================================================================================================================
* FANCYBOX
* ====================================================================================================================*/
$('.fancybox').fancybox();

})(jQuery); // End of use strict
