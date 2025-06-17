/**=====================
   Progress Start
==========================**/
const first = document.querySelector(".first");
const second = document.querySelector(".second");
const third = document.querySelector(".third");
const fourth = document.querySelector(".fourth");
const fifth = document.querySelector(".fifth");
const steps = [first, second, third, fourth, fifth];

function nextStep(currentStep) {
  steps.forEach((step) => step.classList.remove("active"));

  steps.forEach((step, index) => {
    if (index <= currentStep) {
      step.classList.add("active");
    } else {
      step.classList.remove("active");
    }
  });
}

steps.forEach((step, index) => {
  step.addEventListener("click", () => {
    nextStep(index);
  });
});

/**=====================
   Progress End
==========================**/
