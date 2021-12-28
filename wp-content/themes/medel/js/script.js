/*------------------------------------------------------------------
[Master Scripts]

Project:    Medel Theme
Version:    1.1.2

[Table of contents]

[Components]

	-Preloader
	-Stick sidebar
	-Dropdown img
	-Equal Height function
	-Navigation open
	-Search
	-Mobile menu
	-Fixed header
	-Screen rezise events
	-Fix centered container
	-Blog items & filtering
	-Full sreen navigation
	-Animation
	-Animation
	-Load more
	-Comment reply
	-Popup image
	-Parallax
	-Tabs
	-Quantity
	
-------------------------------------------------------------------*/

"use strict";

/*------------------------------------------------------------------
[ Preloader ]
*/
jQuery(window).on('load', function () {
  jQuery(window).trigger('resize').trigger('scroll');
  jQuery('body').addClass('loaded');

  jQuery('.owl-carousel').each(function () {
    jQuery(this).trigger('refresh.owl.carousel');
  });
});

jQuery(document).ready(function () {

  /*------------------------------------------------------------------
  [ Equal Height function ]
  */
  function equalHeight(group) {
    if (jQuery(window).width() > '768') {
      var tallest = 0;
      jQuery(group).each(function () {
        var thisHeight = jQuery(this).css('height', "").height();
        if (thisHeight > tallest) {
          tallest = thisHeight;
        }
      });
      jQuery(group).height(tallest);
    } else {
      jQuery(group).height('auto');
    }
  }

  if (jQuery('.navigation > ul > li').length > 6) {
    jQuery('.navigation').addClass('min');
  }

  jQuery('#wpadminbar').addClass('wpadminbar');

  /*------------------------------------------------------------------
  [ Project slider ]
  */
  jQuery('.project-slider').each(function () {
    var head_slider = jQuery(this);
    if (head_slider.find('.item').length == 1) {
      head_slider.parent().removeClass('with-carousel-nav');
    }
    if (jQuery(this).find('.item').length > 1) {
      head_slider.addClass('owl-carousel').owlCarousel({
        loop: true,
        items: 1,
        nav: true,
        dots: false,
        autoplay: false,
        navClass: ['owl-prev free-basic-ui-elements-left-arrow', 'owl-next free-basic-ui-elements-right-arrow'],
        navText: false,
        responsive: {
          0: {
            nav: false,
          },
          480: {

          },
          768: {
            nav: true,
          },
        },
      });

      var child_carousel = head_slider.next('.project-slider-carousel');

      var i = 0;
      var flag = false;
      var c_items = '4';

      if (head_slider.find('.owl-item:not(.cloned)').find('.item').length < 4) {
        c_items = head_slider.find('.owl-item:not(.cloned)').find('.item').length;
      }

      var child_carousel_c = child_carousel.addClass('owl-carousel').owlCarousel({
        loop: true,
        items: 1,
        nav: true,
        dots: false,
        autoplay: false,
        navClass: ['owl-prev free-basic-ui-elements-left-arrow', 'owl-next free-basic-ui-elements-right-arrow'],
        navText: false,
        margin: 15,
        responsive: {
          0: {
            nav: false,
          },
          480: {

          },
          768: {
            nav: true,
            items: c_items
          },
        },
      }).on('click initialized.owl.carousel', '.item', function (e) {
        e.preventDefault();
        head_slider.trigger('to.owl.carousel', [jQuery(e.target).parents('.owl-item').index(), 300, true]);
        jQuery(e.target).parents('.owl-item').addClass('active-item').siblings().removeClass('active-item');
      }).data('owl.carousel');

      var child_carousel_item = child_carousel.find('.owl-item.active');



      head_slider.on('change.owl.carousel', function (e) {
        if (e.namespace && e.property.name === 'position' && !flag) {
          flag = true;
          child_carousel_c.to(e.relatedTarget.relative(e.property.value), 300, true);
          head_slider.parent().find('.banner-carousel .owl-item.active').first().addClass('active-item').siblings().removeClass('active-item');
          flag = false;
        }
      }).data('owl.carousel');

    }
  });


  /*------------------------------------------------------------------
	[ Search ]
	*/

  jQuery('.site-header .search-button').on("click", function () {
    if (jQuery(this).hasClass('active')) {
      jQuery(this).removeClass('active');
      jQuery('.search-popup').fadeOut();
    } else {
      jQuery(this).addClass('active');
      jQuery('.search-popup').fadeIn();
    }
  });

  jQuery('.search-popup .close').on("click", function () {
    jQuery('.site-header .search-button').removeClass('active');
    jQuery('.search-popup').fadeOut();
  });

  /*------------------------------------------------------------------
  [ Navigation ]
  */

  jQuery('.nav-button.hidden_menu, .nav-button.visible_menu').on('click', function () {
    if (jQuery(this).hasClass('active')) {
      jQuery(this).removeClass('active');
      jQuery('.navigation').removeClass('active');
    } else {
      jQuery(this).addClass('active');
      jQuery('.navigation').addClass('active');
    }
  });

  jQuery('.nav-button.full_screen').on('click', function () {
    if (jQuery(this).hasClass('active')) {
      jQuery(this).removeClass('active');
      jQuery('.full-screen-nav').fadeOut();
    } else {
      jQuery(this).addClass('active');
      jQuery('.full-screen-nav').fadeIn();
    }
  });

  jQuery('.full-screen-nav .close').on("click", function () {
    jQuery('.nav-button.full_screen').removeClass('active');
    jQuery('.full-screen-nav').fadeOut();
  });

  jQuery('.full-screen-nav .menu-item-has-children > a').on("click", function () {
    if (!jQuery(this).hasClass('active')) {
      jQuery(this).addClass('active').parent().children('.sub-menu').slideDown().parent().siblings().children('a').removeClass('active').next('.sub-menu').slideUp();
      return false;
    }
  });

  jQuery('.side-navigation ul li.menu-item-has-children > a,.side-navigation ul li.page_item_has_children > a').on('click', function () {
    jQuery(this).parents('li').addClass('active-child');
    return false;
  });

  jQuery('.side-navigation .sub-menu .back,.side-navigation .children .back').on('click', function () {
    jQuery(this).parent().parent().removeClass('active-child');
    return false;
  });

  /*------------------------------------------------------------------
  [ Side bar ]
  */

  jQuery('.side-bar-button').on('click', function () {
    jQuery('.side-bar-area').addClass('active');
  });

  jQuery('.side-bar-area .close').on("click", function () {
    jQuery('.side-bar-area').removeClass('active');
  });

  /*------------------------------------------------------------------
  [ Fixed header ]
  */

  jQuery(window).on("load resize scroll", function () {
    if (jQuery(document).scrollTop() > 0) {
      jQuery('.site-header').addClass('fixed');
    } else {
      jQuery('.site-header').removeClass('fixed');
    }
  });


  /*------------------------------------------------------------------
  [ Price list ]
  */

  jQuery(document).on('click', ".price-list .item .options .button-style1", function () {
    if (jQuery(this).parent().hasClass('active')) {
      jQuery(this).removeClass('active').parent().removeClass('active').find('.wrap').slideUp();
    } else {
      jQuery(this).addClass('active').parent().addClass('active').find('.wrap').slideDown();
    }
    return false;
  });

  /*------------------------------------------------------------------
  [ Screen rezise events ]
  */

  var nav_el = '';
  if (jQuery('.navigation').hasClass('visible_menu')) {
    nav_el = 'yes';
  }
  jQuery(window).on("load resize", function () {
    /*------------------------------------------------------------------
    [ Mobile menu ]
    */
    if (jQuery(window).width() <= '1200') {
      jQuery('.navigation .menu-item-has-children > a').on("click", function () {
        if (!jQuery(this).hasClass('active')) {
          jQuery(this).addClass('active').parent().children('.sub-menu').slideDown().siblings().children('.sub-menu').slideUp();
          return false;
        }
      });
    }


    jQuery('.header-space').css('height', jQuery('.site-header').outerHeight() + jQuery('.header + .navigation').outerHeight() + jQuery('.ypromo-site-bar').outerHeight());

    jQuery('main.main-row').css('min-height', jQuery(window).outerHeight() - jQuery('.site-footer').outerHeight() - jQuery('.header-space:not(.hide)').outerHeight() - jQuery('.ypromo-site-bar').outerHeight() - jQuery('#wpadminbar').outerHeight());

    jQuery('.banner:not(.fixed-height)').each(function () {
      var coef = 0;
      jQuery(this).css('height', jQuery(window).outerHeight() - jQuery('.header-space:not(.hide)').outerHeight() - jQuery('#wpadminbar').outerHeight() - coef);
      jQuery(this).find('.cell').css('height', jQuery(this).height());
    });
    jQuery('.banner.fixed-height').each(function () {
      jQuery(this).find('.cell').css('height', jQuery(this).height());
    });

    jQuery('.full-screen-nav .cell').css('height', jQuery(window).height() - 20 - jQuery('#wpadminbar').height());

    if (nav_el == "yes") {
      if (jQuery(window).width() > 992) {
        jQuery('.navigation').addClass('visible_menu');
        jQuery('.nav-button').addClass('hidden');
      } else {
        jQuery('.navigation').removeClass('visible_menu');
        jQuery('.nav-button').removeClass('hidden').removeClass('active');
      }
    }

    jQuery('div[data-vc-full-width-mod="true"]').each(function () {
      var coef = (jQuery('.container').outerWidth() - jQuery('#all').width()) / 2;
      jQuery(this).css('left', coef).css('width', jQuery('#all').width());
    });

    jQuery('.blog-type-grid').each(function () {
      equalHeight(jQuery(this).find('.blog-item .wrap'));
      equalHeight(jQuery(this).find('.blog-item h5'));
    });

    jQuery('.blog-type-horizontal').each(function () {
      equalHeight(jQuery(this).find('.blog-item h5'));
    });

    jQuery('.icon-box-items:not(.style2)').each(function () {
      equalHeight(jQuery(this).find('.text'));
      equalHeight(jQuery(this).find('.wrap'));
    });

    jQuery('.team-items').each(function () {
      equalHeight(jQuery(this).find('.team-item .top .cell'));
      equalHeight(jQuery(this).find('.team-item .wrap'));
    });

    jQuery('.price-list-type2').each(function () {
      equalHeight(jQuery(this).find('.item .top .cell'));
    });

    jQuery('.icon-box-item-wrap-type2').each(function () {
      equalHeight(jQuery(this).find('.icon-box-item-type2'));
    });

    jQuery('.testimonials').each(function () {
      equalHeight(jQuery(this).find('.testimonial-item'));
    });

    jQuery('.products.row').each(function () {
      equalHeight(jQuery(this).find('div.product'));
    });

    jQuery('.project-horizontal-slider img, .project-horizontal, .project-horizontal-img').css('height', jQuery(window).outerHeight() - jQuery('.header-space:not(.hide)').height() - jQuery('.site-footer').outerHeight() - jQuery('#wpadminbar').outerHeight());
    jQuery('.project-horizontal .cell').css('height', jQuery('.project-horizontal').outerHeight());

    jQuery('.ph-slider .item img, .ph-slider, .portfolio-h .cell').css('height', jQuery(window).outerHeight() - jQuery('.header-space:not(.hide)').height() - jQuery('.site-footer').outerHeight() - jQuery('.minified-footer').outerHeight() - jQuery('#wpadminbar').outerHeight());

    jQuery('.projects-slider').css('height', jQuery(window).outerHeight() - jQuery('.site-footer').outerHeight() - jQuery('.site-header').outerHeight() - jQuery('.ypromo-site-bar').outerHeight() - jQuery('#wpadminbar').outerHeight());

    jQuery('.portfolio-h').each(function () {
      var parent_w = jQuery(this).width();

      jQuery(this).find('.ph-slider-area').css('margin-right', -(jQuery(window).width() - parent_w) / 2);
    });

    jQuery('.sb-block > .cell').css('height', jQuery(window).outerHeight() - jQuery('.header-space:not(.hide)').height() - jQuery('#wpadminbar').outerHeight());

    /*------------------------------------------------------------------
    [ Fix centered container ]
    */
    jQuery('.centered-container').each(function () {
      var width = parseInt(Math.round(jQuery(this).width()).toFixed(0)),
        height = parseInt(Math.round(jQuery(this).height()).toFixed(0));

      jQuery(this).css('width', '').css('height', '');

      if (width & 1) {
        jQuery(this).css('width', (width + 1) + 'px');
      }

      if (height & 1) {
        jQuery(this).css('height', (height + 1) + 'px');
      }
    });

    /*------------------------------------------------------------------
    [ Parallax ]
    */
    jQuery('.background-parallax').each(function () {
      var wScroll = jQuery(window).scrollTop() - jQuery(this).parent().offset().top + jQuery('#wpadminbar').height() + jQuery('.header-space').height();
      jQuery(this).css('transform', 'translate(0px,' + wScroll + 'px)');
      jQuery(this).parents('.owl-carousel').find('.owl-nav div').css('margin-top', wScroll);
    });
  });

  /*------------------------------------------------------------------
  [ Accordion ]
  */

  jQuery('.accordion-items .item .top').on('click', function () {
    if (jQuery(this).parent().hasClass('active')) {
      jQuery(this).parent().removeClass('active').find('.wrap').slideUp();
    } else {
      jQuery(this).parent().addClass('active').find('.wrap').slideDown();
    }
  });

  /*------------------------------------------------------------------
  [ Image Comparison Slider ]
  */

  jQuery(document).ready(function () {
    jQuery('.image-comparison-slider').each(function () {
      var cur = jQuery(this);
      var width = cur.width() + 'px';
      cur.find('.resize .old').css('width', width);
      drags(cur.find('.line'), cur.find('.resize'), cur);
    });
  });

  jQuery(window).resize(function () {
    jQuery('.image-comparison-slider').each(function () {
      var cur = jQuery(this);
      var width = cur.width() + 'px';
      cur.find('.resize .old').css('width', width);
    });
  });

  function drags(dragElement, resizeElement, container) {

    dragElement.on('mousedown touchstart', function (e) {

      dragElement.addClass('draggable');
      resizeElement.addClass('resizable');

      var startX = (e.pageX) ? e.pageX : e.originalEvent.touches[0].pageX,
        dragWidth = dragElement.outerWidth(),
        posX = dragElement.offset().left + dragWidth - startX,
        containerOffset = container.offset().left,
        containerWidth = container.outerWidth(),
        minLeft = containerOffset + 25,
        maxLeft = containerOffset + containerWidth - dragWidth - 25;

      dragElement.parents().on("mousemove touchmove", function (e) {

        var moveX = (e.pageX) ? e.pageX : e.originalEvent.touches[0].pageX,
          leftValue = moveX + posX - dragWidth;

        if (leftValue < minLeft) {
          leftValue = minLeft;
        } else if (leftValue > maxLeft) {
          leftValue = maxLeft;
        }

        var widthValue = (leftValue + dragWidth / 2 - containerOffset) * 100 / containerWidth + '%';

        jQuery('.draggable').css('left', widthValue).on('mouseup touchend touchcancel', function () {
          jQuery(this).removeClass('draggable');
          resizeElement.removeClass('resizable');
        });
        jQuery('.resizable').css('width', widthValue);
      }).on('mouseup touchend touchcancel', function () {
        dragElement.removeClass('draggable');
        resizeElement.removeClass('resizable');
      });
      e.preventDefault();
    }).on('mouseup touchend touchcancel', function (e) {
      dragElement.removeClass('draggable');
      resizeElement.removeClass('resizable');
    });
  }

  /*------------------------------------------------------------------
  [ Icon box item ]
  */

  jQuery('.style2 .icon-box-item-wrap .top').on('click', function () {
    jQuery(this).parent().addClass('active').find('.wrap').slideDown().parents('.icon-box-item-wrap').siblings().find('.icon-box-item').removeClass('active').find('.wrap').slideUp();
  });

  /*------------------------------------------------------------------
  [ Price list ]
  */

  jQuery(document).on('click', '.price-list-type2 .item .top .button', function () {
    if (jQuery(this).parents('.item').hasClass('active')) {
      jQuery(this).parents('.item').removeClass('active');
    } else {
      jQuery(this).parents('.item').addClass('active');
    }
  });

  /*------------------------------------------------------------------
  [ Scroll next screen ]
  */

  jQuery('.scroll-next-screen').on('click', function () {
    var top = jQuery(this).parent().offset().top + jQuery(this).parent().height() - jQuery('.site-header').outerHeight() - jQuery('.ypromo-site-bar').outerHeight() - jQuery('#wpadminbar').outerHeight();
    jQuery('body, html').animate({
      scrollTop: top
    }, 1100);
    return false;
  });

  /*------------------------------------------------------------------
  [ Project horizontal slider ]
  */
  jQuery('.project-horizontal-slider').each(function () {
    var head_slider = jQuery(this);
    if (head_slider.find('.item').length > 1) {
      head_slider.imagesLoaded(function () {
        head_slider.addClass('owl-carousel').owlCarousel({
          items: 1,
          nav: true,
          dots: false,
          autoplay: false,
          autoWidth: true,
          navClass: ['owl-prev free-basic-ui-elements-left-arrow', 'owl-next free-basic-ui-elements-right-arrow'],
          navText: false,
          margin: 30,
          responsive: {
            0: {
              nav: false,
            },
            480: {

            },
            768: {
              nav: true,
            },
          }
        });
      });
    }
  });


  /*------------------------------------------------------------------
	[ Scroll top button ]
	*/

  jQuery('#scroll-top').on("click", function () {
    jQuery('body, html').animate({
      scrollTop: '0'
    }, 1100);
    return false;
  });

  /*------------------------------------------------------------------
  [ Comment reply ]
  */

  jQuery('.replytocom').on('click', function () {
    var id_parent = jQuery(this).attr('data-id');
    jQuery('#comment_parent').val(id_parent);
    jQuery('#respond').appendTo(jQuery(this).parents('.comment-item'));
    jQuery('#cancel-comment-reply-link').show();
    return false;
  });

  jQuery('#cancel-comment-reply-link').on('click', function () {
    jQuery('#comment_parent').val('0');
    jQuery('#respond').appendTo(jQuery('#commentform-area'));
    jQuery('#cancel-comment-reply-link').hide();
    return false;
  });

  /*------------------------------------------------------------------
  [ Quantity ]
  */

  jQuery('.quantity .down').on("click", function () {
    var val = jQuery(this).parent().find('.input-text').val();
    if (val > 1) {
      val = parseInt(val) - 1;
      jQuery(this).parent().find('.input-text').val(val);
    }
    return false;
  });

  jQuery('.quantity .up').on("click", function () {
    var val = jQuery(this).parent().find('.input-text').val();
    val = parseInt(val) + 1;
    jQuery(this).parent().find('.input-text').val(val);
    return false;
  });

  /*------------------------------------------------------------------
  [ Scills animation ]
  */

  jQuery(window).on('load scroll', function () {
    jQuery('.skill-item .chart').each(function () {
      var top = jQuery(document).scrollTop() + jQuery(window).height();
      var pos_top = jQuery(this).offset().top;
      if (top > pos_top) {
        jQuery(this).addClass('animated');
      }
    });
  });


  if (jQuery('.popup-gallery').length > 0) {
    jQuery('body').append('<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true"> <div class="pswp__bg"></div><div class="pswp__scroll-wrap"> <div class="pswp__container"> <div class="pswp__item"></div><div class="pswp__item"></div><div class="pswp__item"></div></div><div class="pswp__ui pswp__ui--hidden"> <div class="pswp__top-bar"> <div class="pswp__counter"></div><button class="pswp__button pswp__button--close" title="Close (Esc)"></button> <button class="pswp__button pswp__button--share" title="Share"></button> <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button> <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button> <div class="pswp__preloader"> <div class="pswp__preloader__icn"> <div class="pswp__preloader__cut"> <div class="pswp__preloader__donut"></div></div></div></div></div><div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap"> <div class="pswp__share-tooltip"></div></div><button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"> </button> <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"> </button> <div class="pswp__caption"> <div class="pswp__caption__center"></div></div></div></div></div>')

    var $pswp = jQuery('.pswp')[0];
    var image = [];

    jQuery('.popup-gallery').each(function () {
      var $pic = jQuery(this);
      $pic.on('click', '.popup-item, article', function (event) {
        var getItems = function () {
          var items = [],
            $el = '';
          if ($pic.hasClass('owl-carousel')) {
            $el = $pic.find('.owl-item:not(.cloned) a:visible');
          } else {
            $el = $pic.find('a');
          }
          $el.each(function () {
            var $href = jQuery(this).attr('href'),
              $size = jQuery(this).data('size').split('x'),
              $width = $size[0],
              $height = $size[1];

            if (jQuery(this).data('type') == 'video') {
              var item = {
                html: jQuery(this).data('video')
              };
            } else {
              var item = {
                src: $href,
                w: $width,
                h: $height
              }
            }

            items.push(item);
          });
          return items;
        }

        var items = getItems();

        jQuery.each(items, function (index, value) {
          image[index] = new Image();
          if (value['src']) {
            image[index].src = value['src'];
          }
        });

        event.preventDefault();

        var $index = jQuery(this).index();
        if (jQuery(this).parent().hasClass('thumbnails')) {
          $index++;
        }
        if (jQuery(this).parent().hasClass('owl-item')) {
          $index = jQuery(this).data('id');
        }
        if(jQuery(this).parents('.popup-gallery').find('.grid-sizer').length > 0) {
          $index = $index-1;
        }
        var options = {
          index: $index,
          bgOpacity: 0.7,
          showHideOpacity: true
        }

        var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
        lightBox.init();

        lightBox.listen('beforeChange', function () {
          var currItem = jQuery(lightBox.currItem.container);
          jQuery('.pswp__video').removeClass('active');
          var currItemIframe = currItem.find('.pswp__video').addClass('active');
          jQuery('.pswp__video').each(function () {
            if (!jQuery(this).hasClass('active')) {
              jQuery(this).attr('src', jQuery(this).attr('src'));
            }
          });
        });

        lightBox.listen('close', function () {
          jQuery('.pswp__video').each(function () {
            jQuery(this).attr('src', jQuery(this).attr('src'));
          });
        });
      });
    });
  }
});