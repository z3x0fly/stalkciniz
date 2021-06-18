(function($) {
  "use strict";

  $(window).on('scroll', function() {
    if ($(this).scrollTop() > 500) {
      $('.go-top').fadeIn(500);
    } else {
      $('.go-top').fadeOut(500);
    }
  });
  
  // Animate the scroll to top
  $('.go-top').on('click', function(event) {
    event.preventDefault();
    
    $('html, body').animate({scrollTop: 0}, 300);

  })

  $(window).on('load', function() {

    $('#js-preloader').addClass('loaded');

  });

  $(function() {
      $("#tabs").tabs();
  });

  $(document).ready(onDocumentReady);


  /**
   * All functions to be called on $(document).ready() should be in this function
   */
  function onDocumentReady() {

    masonryLayout();
    funFacts();


    var wow = new WOW(
      {
        animateClass: 'animated',
        offset:       100,
        callback:     function(box) {
          console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
      }
    );
    wow.init();

  }

  $('.accordion > li:eq(0) a').addClass('active').next().slideDown();

  $('.accordion a').on('click', function(ev) {
      var dropDown = $(this).closest('li').find('p');

      $(this).closest('.accordion').find('p').not(dropDown).slideUp();

      if ($(this).hasClass('active')) {
          $(this).removeClass('active');
      } else {
          $(this).closest('.accordion').find('a.active').removeClass('active');
          $(this).addClass('active');
      }

      dropDown.stop(false, true).slideToggle();

      ev.preventDefault();
  });

  /**
   * Packery Layout (Masonry)
   */
  function masonryLayout() {
    var grid = $('.masonry-layout'),
      filter = $('.portfolio-filters'),
      filter_li = filter.find('li');

    
    grid.imagesLoaded().progress( function() {

      var items = grid.isotope({
        // options
        layoutMode: 'packery',
        itemSelector: '.masonry-item',
      });

      filter.on('click', 'li', function() {
        var _this = $(this),
          filterValue = $(this).attr('data-filter');

        filter_li.removeClass('active');
        _this.addClass('active');

        items.isotope({ filter: filterValue }); 
      });

    });

  }


  /**
   * Owl Carousel 
   */


  $('.owl-courses').owlCarousel({
      loop: true,
      nav: false,
      dots: true,
      items: 3,
      margin: 0,
      autoplay: false,
      smartSpeed: 700,
      autoplayTimeout: 6000,
      responsive: {
      0: {
          items: 1,
          margin: 0
      },
      460: {
          items: 1,
          margin: 0
      },
      576: {
          items: 2,
          margin: 0
      },
      992: {
          items: 3,
          margin: 0
      }
    }
  });



  $('.owl-testimonials').owlCarousel({
      loop: true,
      nav: true,
      dots: true,
      items: 3,
      margin: 0,
      autoplay: false,
      smartSpeed: 700,
      autoplayTimeout: 6000,
      responsive: {
      0: {
          items: 1,
          margin: 0
      },
      460: {
          items: 1,
          margin: 0
      },
      576: {
          items: 2,
          margin: 0
      },
      992: {
          items: 2,
          margin: 0
      }
    }
  });




  /**
   * Fun Facts
   */
  function funFacts() {
    var counters = $('.count-digit');

    if (counters.length) {
        counters.each(function () {
          var counter = $(this);
          counter.appear(function () {
            counter.parent().css({'opacity': 1});

            //Counter zero type
            var max = parseFloat(counter.text());
            counter.countTo({
                from: 0,
                to: max,
                speed: 1500,
                refreshInterval: 100
            });

        }, {accX: 0, accY: 0});
      });
    }
  }


  $('.skill-box').find('b').each(function (i) {
    return $(this).prop('Counter', 0).animate({
        Counter: $(this).parent().data('percent')
      }, {
        duration: 1000,
        easing: 'swing',
        step(now) {
          return $(this).text(Math.ceil(now) + '%');
        }
      });
    });

    return $('.skill-box .skills-circle li').each(function (i) {
    const _right = $(this).find('.bar-circle-right');
    const _left = $(this).find('.bar-circle-left');
    const _percent = $(this).attr('data-percent');
    let deg = 3.6 * _percent;
    if (_percent <= 50) {
      return _right.animate({
        circle_rotate: deg
      }, {
        step(deg) {
          $(this).css('transform', `rotate(${deg}deg)`);
        },
        duration: 1000
      });
    } else {
      const full_deg = 180;
      deg -= full_deg;
      let run_duration = 1000 * (50 / _percent);
      return _right.animate({
        circle_rotate: full_deg
      }, {
        step(full_deg) {
          $(this).css('transform', `rotate(${full_deg}deg)`);
        },
        duration: run_duration,
        easing: 'linear',
        complete() {
          run_duration -= 1000;
          _left.css({
            'clip': 'rect(0, 144px, 144px, 75px)',
            'background': '#fb638f'
          });
          return _left.animate({
            circle_rotate: deg
          }, {
            step(deg) {
              $(this).css('transform', `rotate(${deg}deg)`);
            },
            duration: Math.abs(run_duration),
            easing: 'linear'
          });
        }
      });
    }
  });
    


})(jQuery);

(function($) {
  "use strict";

  $(document).ready(onDocumentReady);

  // ------------------------------------------------------------------------
    // Classie Script
    // ------------------------------------------------------------------------
    (function(window) {

        function classReg(className) {
            return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
        }
        var hasClass, addClass, removeClass;
        if ('classList' in document.documentElement) {
            hasClass = function(elem, c) {
                return elem.classList.contains(c);
            };
            addClass = function(elem, c) {
                elem.classList.add(c);
            };
            removeClass = function(elem, c) {
                elem.classList.remove(c);
            };
        } else {
            hasClass = function(elem, c) {
                return classReg(c).test(elem.className);
            };
            addClass = function(elem, c) {
                if (!hasClass(elem, c)) {
                    elem.className = elem.className + ' ' + c;
                }
            };
            removeClass = function(elem, c) {
                elem.className = elem.className.replace(classReg(c), ' ');
            };
        }

        function toggleClass(elem, c) {
            var fn = hasClass(elem, c) ? removeClass : addClass;
            fn(elem, c);
        }
        var classie = {
            hasClass: hasClass,
            addClass: addClass,
            removeClass: removeClass,
            toggleClass: toggleClass,
            has: hasClass,
            add: addClass,
            remove: removeClass,
            toggle: toggleClass
        };
        if (typeof define === 'function' && define.amd) {
            define(classie);
        } else {
            window.classie = classie;
        }

    })(window);

  /**
   * All functions to be called on $(document).ready() should be in this function
   */

   var animatedFixedHeader = (function() {
        var site = document.documentElement,
            header = document.querySelector('.site-header'),
            isScrolled = false,
            animateHeaderOn = 50;

        function initializeFixedHeader() {
            window.addEventListener('scroll', function(event) {
                if (!isScrolled) {
                    isScrolled = true;
                    setTimeout(pageScroll, 100);
                }
            }, false);
            window.addEventListener('load', function(event) {
                if (!isScrolled) {
                    isScrolled = true;
                    setTimeout(pageScroll, 100);
                }
            }, false);
        }

        function pageScroll() {
            var sy = scrollVertically();
            if (sy >= animateHeaderOn) {
                classie.add(header, 'is-fixed');
            } else {
                classie.remove(header, 'is-fixed');
            }
            isScrolled = false;
        }

        function scrollVertically() {
            return window.pageYOffset || site.scrollTop;
        }
        if ($(header).hasClass( 'fixed-header' )) {
            initializeFixedHeader();
        }
    })();

     // Close menu
    $("#close-menu").on('click', function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
    // Open menu
    $("#menu-toggle").on('click', function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });


   $(function () {
      $('a[href="#search"]').on('click', function(event) {
          event.preventDefault();
          $('#search').addClass('open');
          $('#search > form > input[type="search"]').focus();
      });
      
      $('#search, #search button.close').on('click keyup', function(event) {
          if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
              $(this).removeClass('open');
          }
      });
      
      
      //Do not include! This prevents the form from submitting for DEMO purposes only!
      $('form').submit(function(event) {
          event.preventDefault();
          return false;
      })
  });

  function onDocumentReady() {
    setTimeout(function() {
      simpleDropDown();
    }, 100);
  }

  function simpleDropDown() {
    var menu_items = $(".header-nav > ul > li");

    menu_items.each(function() {
      var _this = $(this);

      if (_this.find(".sub-menu").length) {
        var dropDownWrapper = _this.find(".sub-menu");

        if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
          _this
            .on("touchstart mouseenter", function() {
              dropDownWrapper.css({
                overflow: "visible",
                visibility: "visible",
                opacity: "1"
              });
            })
            .on("mouseleave", function() {
              dropDownWrapper.css({
                overflow: "hidden",
                visiblity: "hidden",
                opacity: "0"
              });
            });
        } else {
          var config = {
            interval: 0,
            over: function() {
              setTimeout(function() {
                dropDownWrapper.addClass("sub-menu-open");
              }, 150);
            },
            timeout: 150,
            out: function() {
              dropDownWrapper.removeClass("sub-menu-open");
            }
          };

          _this.hoverIntent(config);
        }
      }
    });
  }
})(jQuery);

(function($) {
  "use strict";

  $(document).ready(onDocumentReady);

  /**
   * All functions to be called on $(document).ready() should be in this function
   */
  function onDocumentReady() {
    mobileMenu();
  }

  function mobileMenu() {
    var openMobileNav = $("#menu-show-mobile-nav"),
      mobileNav = $(".mobile-nav-wrapper"),
      overlay = $(".mobile-menu-overlay"),
      dropdownOpener = $(
        "ul.mobile-menu .sub-icon, ul.mobile-menu .has-sub > a"
      ),
      ps = new PerfectScrollbar(".mobile-menu-inner", {
        wheelPropagation: true,
        scrollYMarginOffset: 20,
        suppressScrollX: true
      });

    // Open Mobile Nav
    if (openMobileNav.length && mobileNav.length) {
      openMobileNav.on("tap click", function(e) {
        e.stopPropagation();
        e.preventDefault();

        openMobileNav.addClass("active");
        mobileNav.addClass("is-open");
        overlay.addClass("is-open");
      });
    }

    // Close Mobile Nav
    if (overlay.length) {
      overlay.on("tap click", function() {
        openMobileNav.removeClass("active");
        mobileNav.removeClass("is-open");
        overlay.removeClass("is-open");
      });
    }

    // Open/Close Submenus
    if (dropdownOpener.length) {
      dropdownOpener.each(function() {
        var _this = $(this);

        _this.on("tap click", function(e) {
          var thisItemParent = _this.parent("li"),
            thisItemParentSiblingswithDrop = thisItemParent.siblings(
              ".has-sub"
            );

          if (thisItemParent.hasClass("has-sub")) {
            var submenu = thisItemParent.find("> ul.sub-menu");

            if (submenu.is(":visible")) {
              submenu.slideUp(450, "easeInOutQuad");
              thisItemParent.removeClass("is-open");
            } else {
              thisItemParent.addClass("is-open");

              if (thisItemParentSiblingswithDrop.length === 0) {
                thisItemParent
                  .find(".sub-menu")
                  .slideUp(400, "easeInOutQuad", function() {
                    submenu.slideDown(250, "easeInOutQuad");
                  });
              } else {
                thisItemParent
                  .siblings()
                  .removeClass("is-open")
                  .find(".sub-menu")
                  .slideUp(250, "easeInOutQuad", function() {
                    submenu.slideDown(250, "easeInOutQuad");
                  });
              }
            }
          }
        });
      });
    }

    $(window).on("resize", function() {
      ps.update();
    });
  }
})(jQuery);
