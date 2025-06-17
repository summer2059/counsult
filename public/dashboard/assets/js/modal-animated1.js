// Modal Animated
(function () {
  const openPopupButton = document.getElementById("myModal");
  const popupContainer = document.getElementById("myModal");
  const toast = document.getElementById("liveToastFirst");
  const addDivName = document.getElementById("toasts-body");
  const entrance = document.getElementById("entrance");
  const exit = document.getElementById("exit");

  document.addEventListener("click", (event) => {
    if (!event.target.closest("#myModal") && !event.target.closest("#myModal")) {
      popupContainer.classList.remove("show");
    }
  });

  openPopupButton.addEventListener("click", function () {
    popupContainer.classList.add("show");
    toast.classList.add("show");
    addDivName.textContent = `<option>${entrance.value}</option>` + "  " + `<option>${exit.value}</option>`;

    setTimeout(() => {
      toast.classList.remove("show");
    }, 2000);
  });
})();
