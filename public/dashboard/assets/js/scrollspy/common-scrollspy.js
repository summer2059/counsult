document.querySelectorAll('#nav-tab>[data-bs-toggle="tab"]').forEach((el) => {
  el.addEventListener("shown.bs.tab", () => {
    const target = el.getAttribute("data-bs-target");
    const scrollElem = document.querySelector(`${target} [data-bs-spy="scroll"]`);
    bootstrap.ScrollSpy.getOrCreateInstance(scrollElem).refresh();
  });
});
