(function() {
  var closeAdaptiveMenue, closeModalWindows, closeSandwich, getBodyScrollTop, openModalWindow, openSandwich, resizeCells, resizeModalWindows, resizeSandwich, scrollCurrent, scrollTo;

  $(document).ready(function() {
    var days, month, timelineCount;
    $(".top-info .close").click(function() {
      return $(".top-info").slideUp(333);
    });
    timelineCount = 0;
    $(".timeline .place .section").each(function() {
      return timelineCount += 1;
    });
    $(".timeline .place").addClass("count-" + timelineCount);
    $(".faq .faq-place .question").click(function() {
      $(this).toggleClass("open");
      return $(this).closest("li").find(".answer").slideToggle(333);
    });
    $(".faq .big-list-block .list li.has-children >span").click(function() {
      $(this).closest(".has-children").find("ul").slideToggle(333);
      return $(this).toggleClass("open");
    });
    $(".info-text-block .tabs ul li").click(function() {
      var open = $(this).attr("data-open");
      var wrap = $(this).closest('.info-text-block');
      //$(".info-text-block .tabs ul li").removeClass("active");
      $(this).addClass("active").siblings().removeClass("active");
      wrap.find(".text-block").slideUp(333);
      return wrap.find(".text-block.block-" + open).slideDown(333);
    });
    $(".switcher").click(function() {
      return $(this).toggleClass("off");
    });
    $(".header .level-1 .search").click(function() {
      $(".hidden-search").css({
        "left": 0
      });
      return setTimeout((function() {
        return $(".hidden-search").addClass("open");
      }), 108);
    });
    $(document).click(function(event) {
      if ($(event.target).closest('.hidden-search.open').length) {

      } else {
        if ($(".hidden-search").hasClass("open")) {
          $(".hidden-search.open").css({
            "left": "-100%"
          });
          $(".hidden-search").removeClass("open");
        }
      }
      return event.stopPropagation();
    });
    $(".sandwich-menue ul li a").click(function() {
      var count;
      count = 0;
      $(this).closest("li").find("ul").each(function() {
        return count += 1;
      });
      if (count !== 0) {
        $(this).closest("li").find("ul").slideToggle(333);
        $(this).closest("li").toggleClass("active");
        return false;
      }
    });
    $(".price-block .services .list >ul >li").click(function() {
      if ($(this).closest(".price-block").hasClass("type-two")) {
        return false;
      } else {
        $(this).toggleClass("open");
        return $(this).find("ul").slideToggle(333);
      }
    });
    $(".vac-list .tabs ul li").click(function() {
      var open;
      open = $(this).attr("data-open");
      $(".vac-list .tabs ul li").removeClass("active");
      $(this).addClass("active");
      $(".hidden-blocks .block").slideUp(333);
      return $(".hidden-blocks .block.block-" + open).slideDown(333);
    });
/*    $(".reviews-list .tabs ul li").click(function() {
      var open;
      open = $(this).attr("data-open");
      $(".reviews-list .tabs ul li").removeClass("active");
      $(this).addClass("active");
      $(".hidden-blocks .block").slideUp(333);
      return $(".hidden-blocks .block.block-" + open).slideDown(333);
    });*/
    $(".about-doctor .tabs ul li").click(function() {
      var hiddenBlocksSlider, open;
      open = $(this).attr("data-open");
      $(".about-doctor .tabs ul li").removeClass("active");
      $(this).addClass("active");
      hiddenBlocksSlider = $(".hidden-blocks-slider").data('owlCarousel');
      return hiddenBlocksSlider.goTo(open);
    });
    $('.scrollbar-outer').scrollbar();
    $("select").styler({
      selectPlaceholder: "Выбрать",
      selectSmartPositioning: false
    });
    $(".fancybox").fancybox();
    $(".sandwich").click(function() {
      if ($(this).hasClass("open")) {
        $(this).removeClass("open");
        return closeSandwich();
      } else {
        $(this).addClass("open");
        return openSandwich();
      }
    });
    $(".show-cut").click(function() {
      if ($(this).hasClass("active")) {
        $(this).removeClass("active");
        $(this).closest(".container").find(".cut").slideUp(333);
        return $(this).html("Подробнее");
      } else {
        $(this).addClass("active");
        $(this).closest(".container").find(".cut").slideDown(333);
        return $(this).html("Скрыть");
      }
    });
    month = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
    days = ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'];
    $(".submit-this").click(function() {
      return $(this).closest("form").submit();
    });
    $('input').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red',
      increaseArea: '20%'
    });
    $(".certificates-slider-one").owlCarousel({
      navigation: true,
      pagination: true,
      slideSpeed: 444,
      paginationSpeed: 333,
      singleItem: true,
      touchDrag: true,
      autoPlay: false,
      navigationText: false,
      autoHeight: true
    });
    $(".certificates-slider-two").owlCarousel({
      navigation: true,
      pagination: false,
      slideSpeed: 444,
      paginationSpeed: 333,
      singleItem: false,
      touchDrag: true,
      autoPlay: false,
      items: 4,
      navigationText: false
    });
    $(".doctors-slider").owlCarousel({
      navigation: true,
      pagination: true,
      slideSpeed: 444,
      paginationSpeed: 333,
      singleItem: false,
      touchDrag: true,
      autoPlay: false,
      items: 4,
      navigationText: false
    });
    $(".where-slider").owlCarousel({
      navigation: true,
      pagination: true,
      slideSpeed: 444,
      paginationSpeed: 333,
      singleItem: false,
      touchDrag: true,
      autoPlay: false,
      items: 2,
      navigationText: false,
      itemsDesktop: [1240, 2],
      itemsDesktopSmall: [1000, 2],
      itemsTablet: [600, 1]
    });
    $(".all-news-slider .list").owlCarousel({
      navigation: true,
      pagination: true,
      slideSpeed: 444,
      paginationSpeed: 333,
      singleItem: false,
      touchDrag: true,
      autoPlay: false,
      items: 5,
      autoHeight: true,
      navigationText: false
    });
    $(".articles-slider").owlCarousel({
      navigation: true,
      pagination: true,
      slideSpeed: 444,
      paginationSpeed: 333,
      singleItem: false,
      touchDrag: true,
      autoPlay: false,
      items: 2,
      navigationText: false,
      itemsDesktop: [1240, 2],
      itemsDesktopSmall: [1000, 2],
      itemsTablet: [600, 1]
    });
    
      $(".index-slider").owlCarousel({
        navigation: true,
        pagination: true,
        addClassActive: true,
        slideSpeed: 444,
        paginationSpeed: 333,
        singleItem: true,
        touchDrag: true,
        autoPlay: 5000,
        navigationText: false,
        beforeInit: function(){          
          var bg = $('.index-slider').find('.item').eq(0).data('bg');
          $('.index-slider-place').css('background','#'+bg);
        },
        afterMove: function(){
          var bg = $('.index-slider').find('.owl-item.active .item').data('bg');
          $('.index-slider-place').css('background','#'+bg);
        }
      });

    $(".example-slider").owlCarousel({
      navigation: true,
      slideSpeed: 444,
      paginationSpeed: 333,
      singleItem: true,
      touchDrag: true,
      autoPlay: false,
      navigationText: false
    });
    $(".review-slider").owlCarousel({
      navigation: true,
      pagination: true,
      slideSpeed: 444,
      paginationSpeed: 333,
      singleItem: true,
      touchDrag: true,
      autoPlay: false,
      navigationText: false
    });
    $(".vac-list-slider .list-slider").owlCarousel({
      navigation: true,
      pagination: true,
      slideSpeed: 444,
      paginationSpeed: 333,
      singleItem: true,
      touchDrag: true,
      autoPlay: false,
      autoHeight: true,
      navigationText: false
    });
    $(".slider-actions-block").owlCarousel({
      navigation: true,
      pagination: true,
      slideSpeed: 444,
      paginationSpeed: 333,
      singleItem: true,
      touchDrag: true,
      autoPlay: false,
      navigationText: false
    });
    $(".slider-new-programs").owlCarousel({
      navigation: true,
      pagination: true,
      slideSpeed: 444,
      paginationSpeed: 333,
      singleItem: false,
      items: 1,
      touchDrag: true,
      autoPlay: false,
      navigationText: false,
      itemsDesktop: [1240, 1],
      itemsDesktopSmall: [800, 2],
      itemsTablet: [640, 1]
    });
    $(".hidden-blocks-slider").owlCarousel({
      navigation: true,
      pagination: false,
      slideSpeed: 444,
      paginationSpeed: 333,
      singleItem: true,
      touchDrag: true,
      autoPlay: false,
      navigationText: false,
      autoHeight: true,
      afterAction: function() {
        var current, hiddenBlocksSlider, openTab;
        current = this.owl.currentItem;
        hiddenBlocksSlider = $(".hidden-blocks-slider").data('owlCarousel');
        openTab = parseInt(current) + 1;
        $(".about-doctor .tabs ul li").removeClass("active");
        return $(".about-doctor .tabs ul li:nth-child(" + openTab + ")").addClass("active");
      }
    });
    resizeModalWindows();
    resizeSandwich();
    $(".get-register").click(function() {
      openModalWindow("#register-form-place");
      return false;
    });
    $(".get-callback").click(function() {
      openModalWindow("#callback-form-place");
      return false;
    });
    $(".get-resume").click(function() {
      openModalWindow("#resume-form-place");
      return false;
    });
    $(".modal-window .icons-close, .darkness, .sandwich-menue .title").click(function() {
      closeModalWindows();
      return closeSandwich();
    });
    $(".menue-list .title").click(function() {
      $(this).closest(".section").find(".row").slideToggle(108);
      return $(this).toggleClass("active");
    });
    $(".open-adaptive-menue").click(function() {});
    return $(".open-hidden-buttons").click(function() {
      closeAdaptiveMenue();
      $(".hidden-buttons-menue").show();
      return $(".darkness").show();
    });
  });

  $(window).resize(function() {
    resizeModalWindows();
    return resizeSandwich();
  });

  $(window).scroll(function() {
    if ($("body").hasClass("open-modal-window")) {

    } else {
      return window.currentScroll = getBodyScrollTop();
    }
  });

  openModalWindow = function(xx) {
    closeAdaptiveMenue();
    xx = $(xx);
    $("body").addClass("open-modal-window");
    $(".modal-window").hide();
    xx.show();
    xx.css({
      "position": "absolute"
    });
    $(".wrapper").css({
      "position": "fixed",
      "top": currentScroll * -1
    });
    return $(".darkness").show();
  };

  closeModalWindows = function() {
    var xx;
    xx = $(".modal-window");
    if (xx.attr('id') == 'callback-form-place') {
      xx.find('input[name=clinic]').val('');
    };
    xx.hide();
    xx.css({
      "position": "absolute"
    });
    $(".wrapper").css({
      "position": "relative",
      "top": 0
    });
    $(".darkness").hide();
    closeAdaptiveMenue();
    scrollCurrent();
    return $("body").removeClass("open-modal-window");
  };

  closeAdaptiveMenue = function() {
    return $(".adaptive-menue").hide();
  };

  resizeModalWindows = function() {
    var wHeight;
    wHeight = $(window).height() / 10;
    return $(".modal-window .place").css({
      "marginTop": wHeight
    });
  };

  resizeSandwich = function() {
    var denominator, wHeight, wWidth;
    wWidth = $(window).width();
    wHeight = $(window).height();
    denominator = 3;
    if (wWidth < 800) {
      denominator = 2;
    }
    if (wWidth < 700) {
      denominator = 1.5;
    }
    if (wWidth < 600) {
      denominator = 1.25;
    }
    return $(".sandwich-menue").css({
      "height": wHeight - 48
    });
  };

  openSandwich = function() {
    return $(".sandwich-menue").addClass("open");
  };

  closeSandwich = function() {
    return $(".sandwich-menue").removeClass("open");
  };

  resizeCells = function(object) {
    var blocksArray, blocksMax;
    if (object === void 0) {
      object = $(".cell-need-resize .cell");
    }
    blocksArray = [];
    object.each(function() {
      var blockHeight;
      blockHeight = $(this).height();
      return blocksArray.push(blockHeight);
    });
    blocksMax = Math.max.apply(null, blocksArray);
    return object.css({
      "height": blocksMax
    });
  };

  getBodyScrollTop = function() {
    return self.pageYOffset || (document.documentElement && document.documentElement.scrollTop) || (document.body && document.body.scrollTop);
  };

  scrollCurrent = function() {
    return $('html, body').animate({
      scrollTop: currentScroll
    }, 0);
  };

  scrollTo = function(target) {
    var scrollPath;
    scrollPath = $(target).offset().top - 40;
    return $('html, body').animate({
      scrollTop: scrollPath
    }, 333);
  };

}).call(this);

