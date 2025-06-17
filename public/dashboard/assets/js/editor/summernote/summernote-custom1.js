var edit = function () {
  $(".click2edit").summernote({
    focus: true,
  });
};

var save = function () {
  var markup = $(".click2edit").summernote("code");
  $(".click2edit").summernote("destroy");
};

(function () {
  const dropdownToggle = document.querySelectorAll(".dropdown-toggle");
  console.log("dropdownToggle", dropdownToggle);
  for (var i = 0; i < dropdownToggle.length; i++) {
    dropdownToggle[i].addEventListener("click", function () {
      var current = document.getElementsByClassName("show");
      current[0].className = current[0].className.replace(" show", "");
      this.className += " show";
    });
  }
})();
