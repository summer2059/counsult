/**=====================
    Modal-animated Start
==========================**/

(function () {
  "use strict";
  function testAnim(element, animationClass) {
    element.classList = "modal-dialog " + animationClass + " animated";
  }

  function initModalAnimate() {
    var myModal = document.getElementById("myModal");
    var entrance = document.getElementById("entrance");
    var exit = document.getElementById("exit");

    function handleModalAnimation(event) {
      var anim = event === "show" ? entrance.value : exit.value;
      testAnim(myModal.querySelector(".modal-dialog"), anim);
    }

    myModal.addEventListener("show.bs.modal", function () {
      handleModalAnimation("show");
    });

    myModal.addEventListener("hide.bs.modal", function () {
      handleModalAnimation("hide");
    });
  }

  document.addEventListener("DOMContentLoaded", initModalAnimate);
})();

/**=====================
  Modal-animated Ends
==========================**/
