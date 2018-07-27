(function() {
  var closeAdaptiveMenue, closeSandwich, openSandwich, resizeIndex, resizeModalWindows, resizeSandwich;

  $(document).ready(function() {
    $(".menue li").hover(function() {
      var blockHeight, blockWidth, child, liWidth, offsetLeft;
      child = $(this).find("div");
      liWidth = $(this).width();
      blockWidth = child.width();
      blockHeight = child.height();
      offsetLeft = ((blockWidth - liWidth) / 2) * -1;
      return child.css({
        "left": offsetLeft - 6,
        "top": (blockHeight + 14) * -1
      });
    });
    resizeIndex();
    $(".grand-slider").owlCarousel({
      navigation: true,
      slideSpeed: 444,
      paginationSpeed: 333,
      touchDrag: true,
      singleItem: true,
      autoPlay: 7777,
      items: 1,
      navigationText: false,
      pagination: true
    });
    resizeModalWindows();
    resizeSandwich();
    $(".get-callback").click(function() {
      openModalWindow("#callback-form-place");
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
    $(".open-adaptive-menue").click(function() {
      return openSandwich();
    });
    return $(".open-hidden-buttons").click(function() {
      closeAdaptiveMenue();
      $(".hidden-buttons-menue").show();
      return $(".darkness").show();
    });
  });

  $(window).resize(function() {
    resizeModalWindows();
    resizeSandwich();
    return resizeIndex();
  });

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
    $(".sandwich-menue").width(wWidth / denominator);
    return $(".sandwich-menue").css;
  };

  openSandwich = function() {
    $(".darkness").show();
    $(".sandwich-menue").css({
      "left": 0,
      "position": "absolute"
    });
    return $(".wrapper").css({
      "position": "fixed"
    });
  };

  closeSandwich = function() {
    $(".sandwich-menue").css({
      "left": -1000
    });
    return $(".wrapper").css({
      "position": "relative"
    });
  };

  resizeIndex = function() {
    var wHeight;
    wHeight = $(window).height();
    $(".grand-slider").height(wHeight);
    return $(".grand-slider div").height(wHeight);
  };

}).call(this);

