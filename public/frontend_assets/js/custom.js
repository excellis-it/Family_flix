(function ($) {

  $.fn.menumaker = function (options) {

    var cssmenu = $(this), settings = $.extend({
      title: "Menu",
      format: "dropdown",
      sticky: false
    }, options);

    return this.each(function () {
      cssmenu.prepend('<div id="menu-button">' + settings.title + '</div>');
      $(this).find("#menu-button").on('click', function () {
        $(this).toggleClass('menu-opened');
        var mainmenu = $(this).next('ul');
        if (mainmenu.hasClass('open')) {
          mainmenu.hide().removeClass('open');
        }
        else {
          mainmenu.show().addClass('open');
          if (settings.format === "dropdown") {
            mainmenu.find('ul').show();
          }
        }
      });

      cssmenu.find('li ul').parent().addClass('has-sub');

      multiTg = function () {
        cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
        cssmenu.find('.submenu-button').on('click', function () {
          $(this).toggleClass('submenu-opened');
          if ($(this).siblings('ul').hasClass('open')) {
            $(this).siblings('ul').removeClass('open').hide();
          }
          else {
            $(this).siblings('ul').addClass('open').show();
          }
        });
      };

      if (settings.format === 'multitoggle') multiTg();
      else cssmenu.addClass('dropdown');

      if (settings.sticky === true) cssmenu.css('position', 'fixed');

      resizeFix = function () {
        if ($(window).width() > 1024) {
          cssmenu.find('ul').show();
        }

        if ($(window).width() <= 1024) {
          cssmenu.find('ul').hide().removeClass('open');
        }
      };
      resizeFix();
      return $(window).on('resize', resizeFix);

    });
  };
})(jQuery);

(function ($) {
  $(document).ready(function () {

    $("#cssmenu").menumaker({
      title: "",
      format: "multitoggle"
    });

  });
})(jQuery);






/*----- slier --------*/




$('.slider').slick({
  autoplay: false,
  speed: 2000,
  lazyLoad: 'progressive',
  arrows: false,
  dots: true,
  prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
  nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
  responsive: [

    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false
      }
    }
  ]
});

$('.slick-nav').on('click touch', function (e) {

  e.preventDefault();

  var arrow = $(this);

  if (!arrow.hasClass('animate')) {
    arrow.addClass('animate');
    setTimeout(() => {
      arrow.removeClass('animate');
    }, 2000);
  }

});




$('.help-slide').slick({
  autoplay: false,
  speed: 2000,
  slidesToShow: 1,
  slidesToScroll: 1,
  lazyLoad: 'progressive',
  arrows: true,
  dots: false,
  infinite: true,
  prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
  nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
  responsive: [
    {
      breakpoint: 1367,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 1025,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false
      }
    }
  ]
});



$(".testimonial_slider").slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  arrows: true,
  dots: false,
  speed: 300,
  centerPadding: "20px",
  infinite: true,
  autoplaySpeed: 5000,
  autoplay: true,
  prevArrow:
    '<div class="slick-nav prev-arrow"><i class="fa-solid fa-angle-left"></i></div>',
  nextArrow:
    '<div class="slick-nav next-arrow"><i class="fa-solid fa-angle-right"></i></div>',
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
      },
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      },
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      },
    },
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ],
});

// serv-slide
$('.serv-slider').slick({
  autoplay: false,
  speed: 2000,
  slidesToShow: 4,
  slidesToScroll: 1,
  lazyLoad: 'progressive',
  arrows: false,
  dots: false,
  infinite: true,
  prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
  nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
  responsive: [
    {
      breakpoint: 1367,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 1025,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false
      }
    }
  ]
});

// case-slider
$('.case-slider').slick({
  centerMode: true,
  // centerPadding: '10px',
  autoplay: false,
  speed: 2000,
  slidesToShow: 3,
  slidesToScroll: 1,
  arrows: true,
  dots: false,
  infinite: true,
  prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
  nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
  responsive: [
    {
      breakpoint: 1367,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 1199,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false
      }
    }
  ]
});



// our-service
$('.our-serv-slide').slick({
  autoplay: false,
  speed: 2000,
  slidesToShow: 4,
  slidesToScroll: 1,
  lazyLoad: 'progressive',
  arrows: true,
  dots: false,
  infinite: true,
  prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
  nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
  responsive: [
    {
      breakpoint: 1367,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 1025,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false
      }
    }
  ]
});



// our-service
$('.client-slide').slick({
  autoplay: false,
  speed: 2000,
  slidesToShow: 5,
  slidesToScroll: 1,
  lazyLoad: 'progressive',
  arrows: false,
  dots: false,
  infinite: true,
  prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
  nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
  responsive: [
    {
      breakpoint: 1367,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 1025,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false
      }
    }
  ]
});


// our-service
$('.feature-slide').slick({
  autoplay: false,
  speed: 2000,
  slidesToShow: 3,
  slidesToScroll: 1,
  lazyLoad: 'progressive',
  arrows: true,
  dots: false,
  infinite: true,
  prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
  nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
  responsive: [
    {
      breakpoint: 1367,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 1025,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false
      }
    }
  ]
});



// unbeatable-slider
$('.unbeatable-slider').slick({
  autoplay: true,
  autoplaySpeed: 2000,
  slidesToShow: 6,
  slidesToScroll: 1,
  lazyLoad: 'progressive',
  arrows: false,
  dots: false,
  infinite: true,
  prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
  nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
  responsive: [
    {
      breakpoint: 1367,
      settings: {
        slidesToShow: 5,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 1025,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false
      }
    }
  ]
});
// imdb-slider
$('.imdb-slider').slick({
  autoplay: false,
  autoplaySpeed: 2000,
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  dots: true,
  infinite: true,
  prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
  nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
  responsive: [
    {
      breakpoint: 1367,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 1025,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false
      }
    }
  ]
});


// shows-slider
$('.shows-slider').slick({
  autoplay: true,
  autoplaySpeed: 1000,
  slidesToShow: 4,
  slidesToScroll: 1,
  lazyLoad: 'progressive',
  arrows: false,
  dots: false,
  infinite: true,
  prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
  nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
  responsive: [
    {
      breakpoint: 1367,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 1025,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false
      }
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false
      }
    }
  ]
});


$('.slider-for').slick({
  slidesToShow: 2,
  slidesToScroll: 1,
  arrows: false,
  asNavFor: '.slider-nav',
  responsive: [

    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false
      }
    }
  ]
});
$('.slider-nav').slick({
  slidesToShow: 6,
  slidesToScroll: 1,
  asNavFor: '.slider-for',
  dots: false,
  arrows: true,
  autoplay: true,
  prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
  nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
  responsive: [
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false
      }
    }
  ]
});

// Scroll top js

var btn = $('#scroll-top-btn');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});

// 

$(document).ready(function() {

  var counters = $(".count");
  var countersQuantity = counters.length;
  var counter = [];

  for (i = 0; i < countersQuantity; i++) {
    counter[i] = parseInt(counters[i].innerHTML);
  }

  var count = function(start, value, id) {
    var localStart = start;
    setInterval(function() {
      if (localStart < value) {
        localStart++;
        counters[id].innerHTML = localStart;
      }
    }, 40);
  }

  for (j = 0; j < countersQuantity; j++) {
    count(0, counter[j], j);
  }
});














AOS.init();


AOS.init({disable: 'mobile'});