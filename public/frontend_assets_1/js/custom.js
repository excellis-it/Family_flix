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



/* step-form  23-02-24*/

var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab
        
        function showTab(n) {
          // This function will display the specified tab of the form...
          var x = document.getElementsByClassName("step");
          x[n].style.display = "block";
          //... and fix the Previous/Next buttons:
          if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
          } else {
            document.getElementById("prevBtn").style.display = "inline";
          }
          if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
          } else {
            document.getElementById("nextBtn").innerHTML = "Next";
          }
          //... and run a function that will display the correct step indicator:
          fixStepIndicator(n)
        }
        
        function nextPrev(n) {
          // This function will figure out which tab to display
          var x = document.getElementsByClassName("step");
          // Exit the function if any field in the current tab is invalid:
          if (n == 1 && !validateForm()) return false;
          // Hide the current tab:
          x[currentTab].style.display = "none";
          // Increase or decrease the current tab by 1:
          currentTab = currentTab + n;
          // if you have reached the end of the form...
          if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("signUpForm").submit();
            return false;
          }
          // Otherwise, display the correct tab:
          showTab(currentTab);
        }
        
        function validateForm() {
          // This function deals with validation of the form fields
          var x, y, i, valid = true;
          x = document.getElementsByClassName("step");
          y = x[currentTab].getElementsByTagName("input");
          // A loop that checks every input field in the current tab:
          for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false
              valid = false;
            }
          }
          // If the valid status is true, mark the step as finished and valid:
          if (valid) {
            document.getElementsByClassName("stepIndicator")[currentTab].className += " finish";
          }
          return valid; // return the valid status
        }
        
        function fixStepIndicator(n) {
          // This function removes the "active" class of all steps...
          var i, x = document.getElementsByClassName("stepIndicator");
          for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
          }
          //... and adds the "active" class on the current step:
          x[n].className += " active";
        }





AOS.init();


AOS.init({disable: 'mobile'});