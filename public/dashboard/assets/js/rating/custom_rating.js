(function () {
  // Emoji Rating
  document.querySelectorAll(".feedback li").forEach((entry) =>
    entry.addEventListener("click", (e) => {
      if (!entry.classList.contains("active")) {
        document.querySelector(".feedback li.active").classList.remove("active");
        entry.classList.add("active");
      }
      e.preventDefault();
    })
  );

  // Star Rating
  const starBox = document.querySelectorAll(".star-box i");

  starBox.forEach((star, index1) => star.addEventListener("click", () => starBox.forEach((star, index2) => (index1 >= index2 ? star.classList.add("active") : star.classList.remove("active")))));

  // Emoji with msg
  document.querySelector(".star-widget").onclick = () => {
    document.querySelector(".star-widget").style.display = "block";
  };

  // Stroke Star Rating
  const starBox1 = document.querySelectorAll(".star-box1 i");

  starBox1.forEach((star, index1) => star.addEventListener("click", () => starBox1.forEach((star, index2) => (index1 >= index2 ? star.classList.add("active") : star.classList.remove("active")))));

  // Emoji expression rating
  class FaceRating {
    constructor(qs) {
      this.input = document.querySelector(qs);

      if (this.input) {
        this.input.addEventListener("input", this.update.bind(this));
        this.face = this.input.previousElementSibling;
        this.update();
      }
    }

    update(e) {
      let value = e ? e.target?.value : this.input.defaultValue;
      this.input.value = value;

      const min = this.input.min || 0;
      const max = this.input.max || 100;
      const percentRaw = ((value - min) / (max - min)) * 100;
      const percent = +percentRaw.toFixed(2);

      this.input?.style.setProperty("--percent", `${percent}%`);

      const maxHue = 120;
      const hueExtend = 30;
      const hue = Math.round((maxHue * percent) / 100);

      let hue2 = (hue - hueExtend + 360) % 360;

      [1, 2].forEach((i) => this.face?.style.setProperty(`--face-hue${i}`, i === 1 ? hue : hue2));

      this.input?.style.setProperty("--input-hue", hue);

      const duration = 1;
      const delay = (-(duration * 0.99) * percent) / 100;
      const parts = ["right", "left", "mouth-lower", "mouth-upper"];

      parts.forEach((p) => {
        const el = this.face?.querySelector(`[data-${p}]`);
        el?.style.setProperty(`--delay-${p}`, `${delay}s`);
      });

      const faces = ["Sad face", "Slightly sad face", "Straight face", "Slightly happy face", "Happy face"];
      let faceIndex = Math.min(Math.floor((faces.length * percent) / 100), faces.length - 1);

      this.face?.setAttribute("aria-label", faces[faceIndex]);
    }
  }

  window.addEventListener("DOMContentLoaded", () => {
    const emoji = new FaceRating("#face-rating");
  });

  // Reset Rating
  document.querySelector(".reset-btn").addEventListener("click", () => {
    document.querySelectorAll(".reset-rating > input").forEach((input) => (input.checked = false));
  });

  // Half rating
  var valueHover = 0;
  function calcSliderPos(e, maxV) {
    return (e.offsetX / e.target.clientWidth) * parseInt(maxV, 10);
  }

  $(".starrate").on("click", function () {
    $(this).data("val", valueHover);
    $(this).addClass("saved");
  });

  $(".starrate").on("mouseout", function () {
    upStars($(this).data("val"));
  });

  $(".starrate span.ctrl").on("mousemove", function (e) {
    var maxV = parseInt($(this).parent("div").data("max"));
    valueHover = Math.ceil(calcSliderPos(e, maxV) * 2) / 2;
    upStars(valueHover);
  });

  function upStars(val) {
    var val = parseFloat(val);
    $("#rating-result").html(val.toFixed(1));

    var full = Number.isInteger(val);
    val = parseInt(val);
    var stars = $("#starrate i");

    stars.slice(0, val).attr("class", "fa fa-star");
    if (!full) {
      stars.slice(val, val + 1).attr("class", "fa fa-star-half-o");
      val++;
    }
    stars.slice(val, 5).attr("class", "fa fa-star-o");
  }

  $(document).ready(function () {
    $(".starrate span.ctrl").width($(".starrate span.cont").width());
    $(".starrate span.ctrl").height($(".starrate span.cont").height());
  });
})();
