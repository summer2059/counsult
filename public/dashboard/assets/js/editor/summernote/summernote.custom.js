(function ($) {
  "use strict";
  var summernote_custom = {
    init: function () {
      $(".summernote").summernote({
        height: 300,
        tabsize: 2,
      });
      $(".inline-editor").summernote({
        airMode: true,
      });
      $(".hint2basic").summernote({
        height: 100,
        toolbar: false,
        placeholder: "type with apple, orange, watermelon, lemon",
        hint: {
          words: ["apple", "orange", "watermelon", "lemon"],
          match: /\b(\w{1,})$/,
          search: function (keyword, callback) {
            callback(
              $.grep(this.words, function (item) {
                return item.indexOf(keyword) === 0;
              })
            );
          },
        },
      });
    },
  };
  summernote_custom.init();
})(jQuery);
