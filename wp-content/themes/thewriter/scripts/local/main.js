!function(e){"use strict";
  var pde;

  pde = function(e) {
    if (e.preventDefault) {
      e.preventDefault();
    } else {
      e.returnValue = false;
    }
  };

  (function($) {
    var initPhotoSwipe;
    initPhotoSwipe = function(galleryLinkClass) {
      var hashData, openPhotoSwipe, parseLinks, photoswipeParseHash;
      parseLinks = function(links, galleryUID) {
        var item, j, len, link, results;
        results = [];
        for (j = 0, len = links.length; j < len; j++) {
          link = links[j];
          if (!link.getAttribute('data-pswp-uid') || galleryUID === parseInt(link.getAttribute('data-pswp-uid'), 10)) {
            results.push(item = {
              el: link,
              src: link.getAttribute('href'),
              msrc: link.children[0].getAttribute('src'),
              w: parseInt(link.getAttribute('data-img-width'), 10),
              h: parseInt(link.getAttribute('data-img-height'), 10)
            });
          }
        }
        return results;
      };
      photoswipeParseHash = function() {
        var hash, j, len, pair, params, ref;
        hash = window.location.hash.substring(1);
        params = {};
        if (hash.length < 5) {
          return params;
        }
        ref = hash.split('&');
        for (j = 0, len = ref.length; j < len; j++) {
          pair = ref[j];
          if (!pair) {
            continue;
          }
          pair = pair.split('=');
          if (pair.length < 2) {
            continue;
          }
          params[pair[0]] = pair[1];
        }
        if (params.gid) {
          params.gid = parseInt(params.gid, 10);
        }
        if (params.hasOwnProperty('pid')) {
          params.pid = parseInt(params.pid, 10);
        }
        return params;
      };
      openPhotoSwipe = function(index, galleryUID) {
        var gallery, galleryLinks, items, options, pswpElement;
        if (galleryUID == null) {
          galleryUID = 0;
        }
        pswpElement = document.querySelectorAll('.pswp')[0];
        galleryLinks = document.querySelectorAll(galleryLinkClass);
        items = parseLinks(galleryLinks, galleryUID);
        options = {
          index: index,
          galleryUID: galleryUID,
          closeOnScroll: false,
          bgOpacity: 0.9,
          getThumbBoundsFn: function(index) {
            var pageYScroll, rect, thumbnail;
            thumbnail = items[index].el.getElementsByTagName('img')[0];
            pageYScroll = window.pageYOffset || document.documentElement.scrollTop;
            rect = thumbnail.getBoundingClientRect();
            return {
              x: rect.left,
              y: rect.top + pageYScroll,
              w: rect.width
            };
          }
        };
        gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
        return gallery.init();
      };
      $(document).on('click', galleryLinkClass, function(e) {
        pde(e);
        return openPhotoSwipe($(this).data('img-index'), $(this).data('pswp-uid'));
      });
      hashData = photoswipeParseHash();
      if (hashData.pid > 0 && hashData.gid > 0) {
        openPhotoSwipe(hashData.pid, hashData.gid);
      }
    };
    $(document).ready(function() {
      var animateOnScroll, footer, footerInner, gutter, header, headerWrap, hold, mainWrap, mainWrapMarginLeft, mainWrapMarginRight, postWithImg, postWithoutImg, posts, posts_masonry, productImgChange, screen_lg, screen_md, screen_sm, screen_xl, screen_xs, scrollTop, time, titleWrapper, updatePostHeight, updatePostHeight_masonry, windowHeight, windowWidth;
      scrollTop = 0;
      windowWidth = $(window).width();
      windowHeight = $(window).height();
      screen_xs = 480;
      screen_sm = 768;
      screen_md = 992;
      screen_lg = 1200;
      screen_xl = 1401;
      time = 400;
      hold = 200;
      gutter = 15;
      mainWrap = $('.js--main-w');
      mainWrapMarginLeft = parseFloat(mainWrap.css('marginLeft'));
      mainWrapMarginRight = parseFloat(mainWrap.css('marginRight'));
      headerWrap = $('.js--main-h');
      header = $('.js--main-h-bottom');
      titleWrapper = $('.js--t-w');
      footer = $('.js--main-f');
      footerInner = $('.js--main-f-inner');
      initPhotoSwipe('.js-pswp-img-lk');
      var is_layout3 = ( $('.main-h-bottom-w').hasClass('__layout3-helper') ? true : false );
      if(is_layout3){
        var lo3_pad_top = $('.__layout3-helper').css('padding-top');
        $('#main-content').data('layout3_pt',lo3_pad_top);
        console.log($('#main-content').data('layout3_pt'));
      }
      if($('.main-h-bottom').hasClass('__light')){
        $('.main-h-bottom').find('.__light').addClass('__display-selected-scheme');
      } else {
        $('.main-h-bottom').find('.__dark').addClass('__display-selected-scheme');
      }
      $('.js--scroll-nav a[href^="#"]:not([href="#"])').smoothScroll();
      $('label[for]').each(function(i) {
        var inputId, label;
        label = $(this);
        inputId = label.attr('for');
        if (inputId.length > 0) {
          $(document).on('focus', '#' + inputId, function() {
            return label.addClass('__focus');
          });
          return $(document).on('blur', '#' + inputId, function() {
            return label.removeClass('__focus');
          });
        }
      });
      $('#product-tabs').tabs({
        hide: {
          effect: "fade",
          duration: 200
        },
        show: {
          effect: "fade",
          duration: 200
        }
      });
      $('#wc-account-login-tabs').tabs({
        hide: {
          effect: "fade",
          duration: 200
        },
        show: {
          effect: "fade",
          duration: 200
        }
      });
      productImgChange = function(form, src) {
        var product, productSlides;
        product = form.parents('.js--product');
        productSlides = product.find('.js--slides');
        productSlides.find('img').each(function(i) {
          if ($(this).attr('src') === src) {
            product.find('.flex-control-manual a').eq(i).click();
            product.find('.flex-control-nav a').eq(i).click();
          }
        });
      };

      $(this).on('click', '.js--go_to_top', function(e) {
        pde(e);
        $('html, body').animate({
          scrollTop: 0
        }, scrollTop / 4);
      }).on('click','.js--popup-icon-menu', function() {
        $('body').toggleClass('__overflow-hide');
        if ($(this).hasClass('popup_hide')) {
          $('.js--popup-icon-menu').css('z-index', '50');
          $('.logo-w.__light').css('z-index', '50');
          if(!$('.logo-w.__display-selected-scheme').hasClass('__light')){
            $('.logo-w.__display-selected-scheme').hide();
            $('.logo-w.__light').fadeIn();
          }
          $(this).addClass('popup_active').removeClass('popup_hide');
          $('.js-popup-menu-popup').addClass('show-popup-menu');
          setTimeout(function() {
            $('.popup-menu-popup_bg').addClass('__move_overlay');
            $('.popup-menu-w', '.js-popup-menu-popup').addClass('__js_popup_opacity');
            $('.popup-menu-popup', '.popup-menu-mod').addClass('__js_popup_opacity');
          }, 30);
        } else if ($(this).hasClass('popup_active')) {
          if(!$('.logo-w.__display-selected-scheme').hasClass('__light')){
            $('.logo-w.__light').hide();
            $('.logo-w.__display-selected-scheme').fadeIn();
          }
          $('.popup-menu-w', '.js-popup-menu-popup').removeClass('__js_popup_opacity');
          $('.popup-menu-popup', '.popup-menu-mod').removeClass('__js_popup_opacity');
          $(this).removeClass('popup_active').addClass('popup_hide');
          setTimeout(function() {
            $('.popup-menu-popup_bg').removeClass('__move_overlay');
            $('.js-popup-menu-popup').removeClass('show-popup-menu');
            $('.js--popup-icon-menu').css('z-index', '1');
            $('.logo-w.__light').css('z-index', '1');
          }, 100);
        }
      }).on('click','.js--search-icon-menu', function() {
        $('.js--popup-icon-menu').css('z-index', '1');
        $('.logo-w.__light').css('z-index', '1');
        if ($('div').is('#wpadminbar')) {
          $('.js--search-form-hide').css('top', '71px');
          $('.logo-url>.logo-w.__light').css('top', '50px');
        }
        $('body').addClass('__overflow-hide');
        if ($('.logo-w.__light').hasClass('__display-none')) {
          $('.logo-w.__light').fadeIn();
          $('.logo-w.__dark').fadeOut();
        }
        $(this).addClass('search_active').removeClass('search_hide');
        $('.js--search-form').addClass('show-popup-menu');
        setTimeout(function() {
          $('.logo-url>.logo-w').addClass('__js_popup_opacity');
          $('.js--search-form-hide').addClass('__js_popup_opacity');
          $('.popup-menu-popup_bg').addClass('__move_overlay');
          $('.js-search-form', '.js--search-form').addClass('__js_popup_opacity');
          $('.search-form_it').focus();
        }, 30);
      }).on('click', '.js--search-form-hide', function() {
        $('body').removeClass('__overflow-hide');
        if ($('.logo-w.__light').hasClass('__display-none')) {
          $('.logo-w.__light').fadeOut();
          $('.logo-w.__dark').fadeIn();
        }
        $('.logo-url>.logo-w').removeClass('__js_popup_opacity');
        $('.js--search-form', '.js--search-form').removeClass('__js_popup_opacity');
        $(this).removeClass('search_active').addClass('search_hide');
        setTimeout(function() {
          $('.popup-menu-popup_bg').removeClass('__move_overlay');
          $('.js--search-form-hide').removeClass('__js_popup_opacity');
          $('.js-search-form', '.js--search-form').removeClass('__js_popup_opacity');
          setTimeout(function() {
            $('.js--search-form').removeClass('show-popup-menu');
            $('.js--popup-icon-menu').css('z-index', '50');
            $('.logo-w.__light').css('z-index', '50');
          }, 400);
        }, 100);
      }).on('click', '.js--show-next', function(e) {
        var link;
        link = $(this);
        if ((link.hasClass('js--not-screen-sm') && windowWidth >= screen_sm) || !link.hasClass('js--not-screen-sm')) {
          pde(e);
          if (link.hasClass('js--scroll-disable')) {
            $('html').addClass('__scroll_disable');
          }
          link.next('.js--show-me:not(.__visible)').fadeIn(time).addClass('__visible');
        }
      }).on('click', '.js--focus', function(e) {
        pde(e);
        $(this).parents('.js--focus-w').find('.js--focus-me').focus();
      }).mouseup(function(e) {
        var element;
        element = $('.js--show-me.__visible');
        if (element.hasClass('__visible') && !element.is(e.target) && element.has(e.target).length === 0) {
            element.fadeOut(time, function() {
            element.removeClass('__visible');
          });
        }
      }).on('click', '.js--hide-me', function(e) {
        var element;
        pde(e);
        $('html').removeClass('__scroll_disable');
        element = $(this).parents('.js--show-me');
        return element.fadeOut(time, function() {
          element.removeClass('__visible');
        });
      }).on('click', '.js--lwa-show-register', function(e) {
        pde(e);
        return $('.js--lwa-login').fadeOut(time, function() {
          return $('.js--lwa-register').fadeIn(time);
        });
      }).on('click', '.js--lwa-hide-register', function(e) {
        pde(e);
        return $('.js--lwa-register').fadeOut(time, function() {
          return $('.js--lwa-login').fadeIn(time);
        });
      }).on('click', '.js--lwa-show-remember', function(e) {
        pde(e);
        return $('.js--lwa-login').fadeOut(time, function() {
          return $('.js--lwa-remember').fadeIn(time);
        });
      }).on('click', '.js--lwa-hide-remember', function(e) {
        pde(e);
        return $('.js--lwa-remember').fadeOut(time, function() {
          return $('.js--lwa-login').fadeIn(time);
        });
      }).on('click', '.js--quick-view-btn', function(e) {
        var data, pswpElement;
        pde(e);
        $('html').addClass('__scroll_disable');
        $('.js--popup-quick-view').fadeIn(time);
        pswpElement = document.querySelectorAll('.pswp')[0];
        data = {
          action: 'thewriter_wc_quick_view',
          product: $(this).data('product-id'),
          nonce: ajaxurl.nonce
        };
        $.post(ajaxurl.url, data, function(response) {
          $('.js--popup-quick-view-cnt').append(response).find('select').each(function(i) {
            $(this).wrap('<div class="select-w ' + $(this).data('mod') + '"></div>');
          }).end().find('.variations_form').each(function(i) {
            $(this).wc_variation_form().find('.variations select:eq(0)').change().end().on('found_variation', function(event, variation) {
              productImgChange($(this), variation.image_src);
            });
          });
        });
      }).on('click', '.js--popup-quick-view-close', function(e) {
        pde(e);
        $('html').removeClass('__scroll_disable');
        $(this).parents('.js--popup-quick-view').fadeOut(time, function() {
          return $(this).find('.js--popup-quick-view-cnt').empty();
        });
      }).on('found_variation', '.variations_form', function(event, variation) {
        productImgChange($(this), variation.image_src);
      }).on('click', '.js--masonry-lk', function(e) {
        var link;
        pde(e);
        link = $(this);
        if (link.hasClass('__active')) {
          return;
        }
        link.parents('.js--masonry-nav').find('.__active').removeClass('__active');
        link.addClass('__active');
        $(link.attr('href')).isotope({
          filter: link.data('filter')
        });
      });
      posts = $('.js--post-grid:not(.__sticky)');
      postWithImg = $('.js--post-grid-with-img');
      postWithoutImg = $('.js--post-grid-without-img');
      updatePostHeight = function() {
        var tallestPost;
        tallestPost = 0;
        postWithoutImg.height(postWithImg.first().height());
        posts.css('height', 'auto').each(function(i) {
          tallestPost = $(this).outerHeight() > tallestPost ? $(this).outerHeight() : tallestPost;
        }).height(tallestPost);
        return true;
      };
      posts_masonry = $('.grid-height');
      updatePostHeight_masonry = function() {
        var tallestPost_masonry;
        tallestPost_masonry = 0;
        posts_masonry.css('height', 'auto').each(function(i) {
          tallestPost_masonry = $(this).outerHeight() > tallestPost_masonry ? $(this).outerHeight() : tallestPost_masonry;
        }).height(tallestPost_masonry);
        return true;
      };
      animateOnScroll = function() {
        $('.js--animate-on-screen:not(.js--on-screen)').each(function(i) {
          var animateThis;
          animateThis = $(this);
          if (windowWidth >= screen_md && animateThis.offset().top <= scrollTop + windowHeight * .99) {
            animateThis.addClass('js--on-screen');
            setTimeout((function() {
              return animateThis.addClass('__on_screen');
            }), i * hold);
            setTimeout((function() {
              return animateThis.removeClass('animate-on-screen __on_screen js--animate-on-screen');
            }), i * hold + time * 2);
          }
        });
      };
      $(window).on('load', function() {
        var is_blocks = ( $(document).find('.post-layout-blocks').first().length>0 ? true : false );
        if (is_blocks) {
          var is_blocks_img_height = '';
          $('.post-layout-blocks img').each(function(){
            is_blocks_img_height = $(this).height();
            if ( is_blocks_img_height > 0 ) {
              $('.post-audio iframe').height(is_blocks_img_height);
              $('.post-video').css('height',is_blocks_img_height+'px').children().height(is_blocks_img_height);
              return;
            }
          });
        }
        var whfpu = $(window).height();
        $('.popup-menu-w ul').each(function(){
          if($(this).height() < whfpu){
            $(this).css('height',whfpu);
          }
        })
        var count_sub = 0;
        var headerOffsetTop, headerScroll, headerWrapHeight, showGoToTop, titleWrapperBG, titleWrapperBottom, titleWrapperBottomScroll, titleWrapperContainer, titleWrapperContainerHeight, titleWrapperNewHeight, titleWrapperOffset, titleWrapperOffsetTop, titleWrapperScroll, updatePage;
        if (headerWrap.hasClass('__negative')) {
          headerWrapHeight = headerWrap.height();
          $('.js--under-main-h').height(headerWrapHeight);
          headerWrap.height(0);
        }
        if (header.hasClass('js--fixed-header')) {
          header.parent().height(header.parent().height());
          headerOffsetTop = header.offset().top;
          headerScroll = function() {
            if (scrollTop >= windowHeight / 2) {
              return header.addClass('__fixed');
            } else {
              return header.removeClass('__fixed');
            }
          };
        } else {
          headerScroll = function() {};
        }
        $('.js-popup-menu').find('li').each(function(){
          var text = $(this).children('a').text();
          $(this).addClass('coub');
          $(this).children('a').addClass('coub_elem').attr('data-hover', text);
        });
        $('.js-popup-menu').find('.sub-menu').each(function(i) {
          $(this).prepend('<li class="menu-item __back"><a href="#" class="js-popup-menu-back fbq-sm-button-invert"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> back</a></li>');
          $(this).children('li:not(.__back)').each(function() {
            var text = $(this).children('a').text();
            $(this).addClass('coub');
            $(this).children('a').addClass('coub_elem').attr('data-hover', text);
          });
        }).end().on('click', 'li:not(.menu-item-has-children) > a[href^="#"]:not([href="#"]), li:not(.page_item_has_children) > a[href^="#"]:not([href="#"])', function(e) {
          $('.js--show-me.__visible').fadeOut(time, function() {
            $(this).removeClass('__visible');
          });
        }).on('click', '.menu-item-has-children > a, .page_item_has_children > a', function(e) {
          pde(e);
          $(this).siblings().show(0, function() {
            $(this).addClass('__active_sub_menu');
            if($(this).parents('nav').hasClass('popup-menu-w')){
              $(this).css('display','flex');
            }
          }).parent().addClass('__hide_menu_item __active_menu_item').siblings().addClass('__hide_menu_item');
        }).on('click', '.js-popup-menu-back', function(e) {
          var link;
          pde(e);
          link = $(this);
          link.parent().parent().removeClass('__active_sub_menu').parent().removeClass('__hide_menu_item __active_menu_item').siblings().removeClass('__hide_menu_item');
          setTimeout((function() {
            return link.parent().parent().css('display', 'none');
          }), time);
        });
        titleWrapperBG = $('.js--t-w-bg');
        titleWrapperContainer = $('.js--t-w-cnt');
        titleWrapperBottom = $('.js--scroll-bottom');
        if (titleWrapper.hasClass('js--t-w')) {
          titleWrapperOffset = titleWrapper.offset();
          titleWrapperOffsetTop = titleWrapperOffset.top;
        }
        if (titleWrapper.hasClass('__full-height')) {
          titleWrapperNewHeight = windowHeight - headerWrap.height();
          titleWrapperContainerHeight = titleWrapperContainer.height();
          if (titleWrapperNewHeight > titleWrapper.outerHeight()) {
            $('.js--under-main-h').remove();
            titleWrapper.css({
              paddingTop: (titleWrapperNewHeight - titleWrapperContainerHeight) / 2,
              paddingBottom: 0,
              height: titleWrapperNewHeight
            });
          }
        }
        if (titleWrapper.hasClass('__parallax')) {
          titleWrapperScroll = function() {
            if (scrollTop > titleWrapperOffsetTop && scrollTop < windowHeight) {
              titleWrapperBG.css({
                'transform': 'translate(0, ' + (scrollTop - titleWrapperOffsetTop) * 0.25 + 'px)'
              });
              titleWrapperContainer.css({
                'transform': 'translate(0, ' + (scrollTop - titleWrapperOffsetTop) * 0.5 + 'px)',
                'opacity': (100 - scrollTop * 100 / windowHeight) / 100
              });
            } else if (scrollTop < windowHeight) {
              titleWrapperBG.css({
                'transform': 'translate(0,0)'
              });
              titleWrapperContainer.css({
                'transform': 'translate(0,0)',
                'opacity': 1
              });
            }
          };
          if (titleWrapperBottom.hasClass('js--scroll-bottom')) {
            titleWrapperBottomScroll = function() {
              if (scrollTop < windowHeight) {
                titleWrapperBottom.css({
                  'transform': 'translate(0, ' + scrollTop * 0.2 + 'px)'
                });
              } else {
                titleWrapperBottom.css({
                  'transform': 'translate(0,0)'
                });
              }
            };
          } else {
            titleWrapperBottomScroll = function() {};
          }
        } else {
          titleWrapperScroll = function() {};
          titleWrapperBottomScroll = function() {};
        }
        showGoToTop = function() {
          if (scrollTop > windowHeight) {
            return $('.js--go_to_top').addClass('__visible');
          } else {
            return $('.js--go_to_top').removeClass('__visible');
          }
        };
        updatePage = function() {
          scrollTop = window.pageYOffset;
          headerScroll();
          titleWrapperScroll();
          titleWrapperBottomScroll();
          showGoToTop();
          requestAnimationFrame(updatePage);
        };
        if (windowWidth >= screen_md) {
          requestAnimationFrame(updatePage);
        }
        updatePostHeight();
        updatePostHeight_masonry();

        $('.js--masonry').isotope({
          layoutMode: 'masonry'
        });
        setInterval(animateOnScroll, hold * 2);
        if (footer.hasClass('js--main-f-fixed') && windowWidth >= screen_md) {
          footer.height(footerInner.height()).addClass('__fixed');
        }
      }).on('resize orientationchange', function() {
        var is_blocks = ( $(document).find('.post-layout-blocks').first().length>0 ? true : false );
        if (is_blocks) {
          setTimeout(function () {
            var is_blocks_img_height = '';
            $('.post-layout-blocks img').each(function(){
              is_blocks_img_height = $(this).height();
              if ( is_blocks_img_height > 0 ) {
                $('.post-audio iframe').css('height',is_blocks_img_height+'px');
                $('.post-video').css('height',is_blocks_img_height+'px').children().css('height',is_blocks_img_height+'px');
                return;
              }
            });
          }, 200);
        }
        windowWidth = $(window).width();
        windowHeight = $(window).height();
        if (footer.hasClass('js--main-f-fixed') && windowWidth >= screen_md) {
          footer.height(footerInner.height()).addClass('__fixed');
        } else {
          footer.removeClass('__fixed');
        }
        requestAnimationFrame(updatePostHeight);
        requestAnimationFrame(updatePostHeight_masonry);
      });

    });
  })(jQuery);
}(jQuery);
