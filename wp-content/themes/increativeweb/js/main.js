var $ = jQuery.noConflict();

(function ($) {
  $(document).ready(function () {
    "use strict";
	  
    /* MENU TOGGLE */
    $('.side-widget .site-menu ul li i').on('click', function (e) {
      $(this).toggleClass('is-toggle');
      $(this).parent().children('.side-widget .site-menu ul li ul').toggle();
      return true;
    });


    // ACCORDION 
    $(".accordion #collapse1").addClass("show");
    $('.accordion .card:first-child .card-header a').attr('aria-expanded', 'true');


    // TAB
    $(".tab-wrapper .tab-nav li:first-child").addClass("active");
    $(".tab-wrapper #tab1").css("display", "block");
    $(".tab-nav li").on('click', function (e) {
      $(".tab-item").hide();
      $(".tab-nav li").removeClass('active');
      $(this).addClass("active");
      var selected_tab = $(this).find("a").attr("href");
      $(selected_tab).stop().show();
      return false;
    });

    // ADD ARROW in ICW BUTTON
    if($('.icw-btn').length) {
      $('.icw-btn').each(function() {
        if ($(this).find('.arrow').length === 0) {
          $(this).append('<span class="arrow"></span>');
        }
      });
    }
    // SEARCH BOX
    $('.navbar .search-button').on('click', function (e) {
      $(this).toggleClass('open');
      $(".search-box").toggleClass('active');
      $("body").toggleClass("overflow");
    });


    // HAMBURGER MENU
    $('.hamburger-menu').on('click', function (e) {
      $('.hamburger-menu').toggleClass('open');
      $(".side-widget").toggleClass('active');
    });


    // LOGO HOVER
    $(".logo-item, .case-gallery li figure img").on({
      mouseenter: function () {
        $('.logo-item, .case-gallery li figure img').not(this).css({
          "opacity": "0.3"
        });
      },
      mouseleave: function () {
        $('.logo-item, .case-gallery li figure img').not(this).css({
          "opacity": "1"
        });
      }
    });


    // PAGE TRANSITION
    $('.navbar a').on('click', function (e) {

      if (typeof $(this).data('fancybox') == 'undefined') {
        e.preventDefault();
        var url = this.getAttribute("href");
        if (url.indexOf('#') != -1) {
          // var hash = url.substring(url.indexOf('#'));
          // if ($('body ' + hash).length != 0) {
            $('.page-transition').removeClass("active");
          // }
        } else {
          $('.page-transition').toggleClass("active");
          setTimeout(function () {
            window.location = url;
          }, 1000);

        }
      }
    });


  });
  // END DOCUMENT READY



  icw_cf7_labels();

  // SLIDER
  var mainslider = new Swiper('.hero-slider-main', {
    spaceBetween: 0,
    grabCursor: true,
    // lazy: true,
    autoHeight: true,
    autoplay: {
      delay: 6000,
      disableOnInteraction: false,
    },
    loop: true,
    // touchRatio: 0,
    effect: "cards",
    loopedSlides: 1,
    thumbs: {
      swiper: slidercontent
    }
  });
  // SLIDER CONTENT
  var slidercontent = new Swiper('.hero-slider-content', {
    // direction: "vertical",
    grabCursor: true,
    spaceBetween: 10,
    centeredSlides: true,
    slidesPerView: 1,
    // touchRatio: 0.2,
    effect: 'fade',
    slideToClickedSlide: true,
    loop: true,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
      renderBullet: function (index, className) {
        return '<span class="' + className + '"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30"><circle r="13" cy="15" cx="15"></circle></svg></span>';
      },
    },
    // breakpoints: {
    //   768: {
    //     direction: 'horizontal',
    //   }
    // }
  });

  if ($(".hero-slider-main")[0]) {
    mainslider.controller.control = slidercontent;
    slidercontent.controller.control = mainslider;
  } else {}


  // CAROUSEL SLIDER
  var swiper = new Swiper('.carousel-slider', {
    slidesPerView: 4,
    spaceBetween: 30,
    watchOverflow: true,
    initialSlide: 0,
    loop: false,
    // Disable preloading of all images
    preloadImages: false,
    // Enable lazy loading
    lazy: true,
    navigation: {
      nextEl: '.button-next',
      prevEl: '.button-prev',
    },
     pagination: {
        el: '.swiper-pagination',
        clickable: true,
        // renderBullet: function (index, className) {
        //     return '<span class="' + className + '"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30"><circle r="13" cy="15" cx="15"></circle></svg></span>';
        // },
    },
    breakpoints: {
      320: {
        slidesPerView: 1.2,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
      1200: {
        slidesPerView: 4,
        spaceBetween: 50,
      },
    }
  });
  
  // Job SLIDER
  var swiper = new Swiper('.job-slider', {
    slidesPerView: 4,
    spaceBetween: 30,
    watchOverflow: true,
    initialSlide: 0,
    loop: false,
    navigation: {
      nextEl: '.button-next',
      prevEl: '.button-prev',
    },
     pagination: {
        el: '.swiper-pagination',
        clickable: true,
        // renderBullet: function (index, className) {
        //     return '<span class="' + className + '"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30"><circle r="13" cy="15" cx="15"></circle></svg></span>';
        // },
    },
    breakpoints: {
      320: {
        slidesPerView: 1.2,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 3.2,
      },
      1024: {
        slidesPerView: 3.2,
      },
      1200: {
        slidesPerView: 4,
      },
    }
  });

  // Blog SLIDER
  var swiper = new Swiper('.post-slider', {
    slidesPerView: 3,
    spaceBetween: 30,
    initialSlide: 0,
    loop: false,
    // Disable preloading of all images
    preloadImages: false,
    // Enable lazy loading
    lazy: true,
    navigation: {
      nextEl: '.button-next',
      prevEl: '.button-prev',
    },
     pagination: {
        el: '.swiper-pagination',
        clickable: true,
        // renderBullet: function (index, className) {
        //     return '<span class="' + className + '"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30"><circle r="13" cy="15" cx="15"></circle></svg></span>';
        // },
    },
    breakpoints: {
      320: {
        slidesPerView: 1.2,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 2.2,
        spaceBetween: 30,
        navigation:false,
      },
      1024: {
        slidesPerView: 3,
      },
      1200: {
        slidesPerView: 3,
      },
    }
  });


  // Project SLIDER
  var swiper = new Swiper('.recent-cases-slider', {
    slidesPerView: 4,
    spaceBetween: 30,
    watchOverflow: true,
    initialSlide: 0,
    loop: false,
    navigation: {
      nextEl: '.button-next',
      prevEl: '.button-prev',
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 15,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      1024: {
        slidesPerView: 4,
        spaceBetween: 30,
      },
    }
  });


  // TESTIMONIALS SLIDER
  var swiper = new Swiper('.testimonials-slider', {
    slidesPerView: 1,
    // grabCursor: true,
    spaceBetween: 50,
    loop: true,
    // autoHeight: true,
    autoplay: {
      delay: 10000,
      disableOnInteraction: false,
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
      // renderBullet: function (index, className) {
      //     return '<span class="' + className + '"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30"><circle r="13" cy="15" cx="15"></circle></svg></span>';
      // },
  },
  });

  if($('.client-slider').length) {
    var logoSwiper = new Swiper(".client-slider", {
        slidesPerView: 2,
        spaceBetween: 5,
        freeMode: true,
        loop: true,
        lazy: true,
        lazy: {
            loadPrevNext: false,
            loadOnTransitionStart: true
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },        
        navigation: {
          nextEl: '.button-next',
          prevEl: '.button-prev',
        },
        breakpoints: {
            767: {
                slidesPerView: 3,
            },
            992: {
                slidesPerView: 4,
            },
            1200: {
                slidesPerView: 4,
            },
            1600: {
                slidesPerView: 5,
            },
            1920: {
                slidesPerView: 6,
            },
        },
    });
}


  // STEPS SLIDER
  var swiper = new Swiper('.steps-slider', {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: false,
    initialSlide: 0,
    pagination: {
      el: '.swiper-pagination',
      type: 'fraction',
    },
    navigation: {
      nextEl: '.button-next',
      prevEl: '.button-prev',
    },
    breakpoints: {
      320: {
        slidesPerView: 1.1,
      },
      768: {
        slidesPerView: 1,
      }
    }
  });


  // STEPS SLIDER
  var swiper = new Swiper('.office-slider', {
    slidesPerView: 3.2,
    spaceBetween: 30,
    centeredSlides: true,
    loop: true,
    navigation: {
      nextEl: '.button-next',
      prevEl: '.button-prev',
    },
    breakpoints: {
      320: {
        slidesPerView: 1.5,
        spaceBetween: 5,
        navigation: false,
      },
      768: {
        slidesPerView: 2.2,
        spaceBetween: 20,
        navigation: false,
      },
      1024: {
        slidesPerView: 3.2,
      },
      1200: {
        slidesPerView: 3.2,
      },
    }
  });


  // COUNTER
  $(document).scroll(function () {
    $('.odometer').each(function () {
      var parent_section_postion = $(this).closest('section').position();
      var parent_section_top = parent_section_postion.top;
      if ($(document).scrollTop() > parent_section_top - 300) {
        if ($(this).data('status') == 'yes') {
          $(this).html($(this).data('count'));
          $(this).data('status', 'no');
        }
      }
    });
  });


  // DATA BACKGROUND IMAGE
  var pageSection = $("*");
  pageSection.each(function (indx) {
    if ($(this).attr("data-background")) {
      $(this).css("background", "url(" + $(this).data("background") + ")");
    }
  });

  // DATA BACKGROUND COLOR
  var pageSection = $("*");
  pageSection.each(function (indx) {
    if ($(this).attr("data-background")) {
      $(this).css("background", $(this).data("background"));
    }
  });


  // PARALLAX
  // $.stellar({
  //   horizontalScrolling: false,
  //   verticalOffset: 0,
  //   responsive: true
  // });


  // STICKY NAVBAR
  $(window).on("scroll touchmove", function (e) {
    $('.navbar').toggleClass('sticky', $(document).scrollTop() > 0);

  });


  // STICKY UP DOWN
  var didScroll;
  var lastScrollTop = 0;
  var delta = 0;
  var navbarHeight = $('.navbar').outerHeight();

  $(window).scroll(function (event) {
    didScroll = true;
  });

  setInterval(function () {
    if (didScroll) {
      hasScrolled();
      didScroll = true;
    }
  }, 0);

  function hasScrolled() {
    var st = $(this).scrollTop();

    // Make sure they scroll more than delta
    if (Math.abs(lastScrollTop - st) <= delta)
      return;

    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight) {
      // Scroll Down
      $('.navbar').removeClass('nav-down').addClass('nav-up');
    } else {
      // Scroll Up
      if (st + $(window).height() < $(document).height()) {
        $('.navbar').removeClass('nav-up').addClass('nav-down');
      }
    }

    lastScrollTop = st;
  };

  $("a.hash-link[href^='#']").on('click', function(e) {
    // prevent default anchor click behavior
    e.preventDefault();
    // store hash
    var hash = this.hash;
    // animate
    $('html, body').animate({
        scrollTop: $(hash).offset().top-80
      }, 700, function(){
        // when done, add hash to url
        // (default click behaviour)
        // window.location.hash = hash;
      });
      return false;
 });

  // MASONRY
  // var $container = $(".masonry");
  // $container.imagesLoaded(function () {
  //   $container.isotope({
  //     itemSelector: '.masonry li',
  //     layoutMode: 'masonry'
  //   });
  // });


  // PRELOADER
  $(window).load(function () {
    $("body").addClass("page-loaded");
  });


  // ICW CURSOR
  document.addEventListener("DOMContentLoaded", function(event) {
    var cursor = document.querySelector(".icw-cursor");
    var links = document.querySelectorAll("a, .svg,.slider-prev,.slider-next,.button-prev,.button-next,.swiper-pagination-bullet");
    var btnlinks = document.querySelectorAll(".btn");
    var initCursor = false;

    for (var i = 0; i < btnlinks.length; i++) {
        var selfLink = btnlinks[i];

        selfLink.addEventListener("mouseover", function() {
            cursor.classList.add("drag");
        });
        selfLink.addEventListener("mouseout", function() {
            cursor.classList.remove("drag");
        });
        
    }

    for (var i = 0; i < links.length; i++) {
        var selfLink = links[i];

        selfLink.addEventListener("mouseover", function() {
            cursor.classList.add("icw-cursor--link");
        });
        selfLink.addEventListener("mouseout", function() {
            cursor.classList.remove("icw-cursor--link");
        });
        
    }
    
    window.onmousemove = function(e) {
        var mouseX = e.clientX;
        var mouseY = e.clientY;

        if (!initCursor) {
            // cursor.style.opacity = 1;
            TweenMax.to(cursor, 0.3, {
                opacity: 1
            });
            initCursor = true;
        }

        TweenMax.to(cursor, 0, {
            top: mouseY + "px",
            left: mouseX + "px"
        });
    };

    window.onmouseout = function(e) {
        TweenMax.to(cursor, 0.3, {
            opacity: 0
        });
        initCursor = false;
    };
    
});


$('#main-content').on('contextmenu', 'img', function(e){ 
  return false; 
});

})(jQuery);
var copy = document.querySelector(".logos-slide").cloneNode(true);
document.querySelector(".logos").appendChild(copy);

function icw_cf7_labels() {
  var input = $('.form-control');
  if (input.length) {

     $(".form-control").each(function(){
        var input_value = $(this).val();
        if(input_value!='') {
            $(this).parents(".form-group").addClass("focused");
        }
      });

     input.focus(function () {
        // console.log("__focus");
        $(this).parents('.form-group').addClass('focused').removeClass('has-data');
     });
     input.focusout(function () {
        // console.log("__focusout");
        $(this).parents('.form-group').removeClass('focused');
        if (this.value == "") {
           $(this).parents('.form-group').removeClass('focused');
           $(this).parents('.form-group').removeClass('has-data');
        } else {
           $(this).parents('.form-group').removeClass('focused').addClass('has-data');
        }
     });
  }
}