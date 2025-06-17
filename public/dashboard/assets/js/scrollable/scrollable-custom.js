(function ($) {
  "use strict";

  var scrollable_custom = {
    init: function () {
      $(".vertical-scroll").perfectScrollbar({
        suppressScrollX: !0,
        wheelPropagation: !0,
      }),
        $(".horizontal-scroll").perfectScrollbar({
          suppressScrollY: !0,
          wheelPropagation: !0,
        }),
        $(".both-side-scroll").perfectScrollbar({
          wheelPropagation: !0,
        }),
        $(".visible-scroll").perfectScrollbar({
          wheelPropagation: !0,
        }),
        $(".scrollbar-margins").perfectScrollbar({
          wheelPropagation: !0,
        }),
        $(".click-drag-handler").perfectScrollbar({
          handlers: ["click-rail", "drag-scrollbar"],
          wheelPropagation: !0,
        });
    },
  };
  scrollable_custom.init();
})(jQuery);

// (function () {
//   document.addEventListener("DOMContentLoaded", function () {
//     "use strict";

//     var scrollable_custom = {
//       init: function () {
//         this.initPerfectScrollbar(".vertical-scroll", { suppressScrollX: true, wheelPropagation: true });
//         this.initPerfectScrollbar(".horizontal-scroll", { suppressScrollY: true, wheelPropagation: true });
//         this.initPerfectScrollbar(".both-side-scroll", { wheelPropagation: true });
//         this.initPerfectScrollbar(".visible-scroll", { wheelPropagation: true });
//         this.initPerfectScrollbar(".scrollbar-margins", { wheelPropagation: true });
//         this.initPerfectScrollbar(".click-drag-handler", { handlers: ["click-rail", "drag-scrollbar"], wheelPropagation: true });
//       },
//       initPerfectScrollbar: function (selector, options) {
//         var elements = document.querySelectorAll(selector);
//         elements.forEach(function (element) {
//           new PerfectScrollbar(element, options);
//         });
//       },
//     };

//     scrollable_custom.init();
//   });
// })();
