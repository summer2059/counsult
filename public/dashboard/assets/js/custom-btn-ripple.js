(function () {
  document.addEventListener("DOMContentLoaded", function () {
    document.addEventListener("click", function (event) {
      if (event.target.classList.contains("ripple-button")) {
        const button = event.target;
        const offset = button.getBoundingClientRect();
        const span = document.createElement("span");
        span.classList.add("ripple-span");
        span.style.top = `${event.clientY - offset.top}px`;
        span.style.left = `${event.clientX - offset.left}px`;
        button.appendChild(span);
        setTimeout(() => {
          span.remove();
        }, 2200);
      }
    });
  });
})();
