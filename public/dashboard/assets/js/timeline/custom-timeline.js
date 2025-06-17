$(document).ready(function () {
  var $element = $(".timeline-event, .title");
  var $window = $(window);
  $window.on("mousewheel DOMMouseScroll touchmove", check_for_fade);
  $(window).on("scroll", check_for_fade);
  $(window).keydown(function(event) {
    if (event.keyCode === 40) {
      check_for_fade();
    }
  });
  check_for_fade();
  function check_for_fade() {
    var window_height = $window.height();
    $.each($element, function (event) {
      var $element = $(this);
      var element_height = $element.outerHeight();
      var element_offset = $element.offset().top;
      space = window_height - (element_height + element_offset - $(window).scrollTop());
      if (space < 60) {
        $element.addClass("non-focus");
      } else {
        $element.removeClass("non-focus");
      }
    });
  }
});