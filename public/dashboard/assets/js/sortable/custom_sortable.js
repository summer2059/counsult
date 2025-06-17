(function () {
  "use strict;";

  var basicList = document.getElementById("basic-list"),
    mixLeft = document.getElementById("mix-left"),
    mixRight = document.getElementById("mix-right"),
    disableList = document.getElementById("disable-list"),
    sortableHandle = document.getElementById("sortable-handle"),
    draggableFilter = document.getElementById("draggable-filter"),
    sortableGrids = document.getElementById("sortable-grids"),
    sortableSwap = document.getElementById("sortable-swap");

  //   Basic List
  new Sortable(basicList, {
    animation: 150,
    ghostClass: "blue-background-class",
  });

  // Mix List
  new Sortable(mixLeft, {
    group: "shared", // set both lists to same group
    animation: 150,
  });

  new Sortable(mixRight, {
    group: "shared",
    animation: 150,
  });

  //   Disabled List
  new Sortable(disableList, {
    group: {
      name: "shared",
      pull: "clone",
      put: false, // Do not allow items to be put into this list
    },
    animation: 150,
    sort: false, // To disable sorting: set sort to false
  });

  //   Handle List
  new Sortable(sortableHandle, {
    handle: ".handle", // handle's class
    animation: 150,
  });

  //   Draggable Filter
  new Sortable(draggableFilter, {
    filter: ".filtered", // 'filtered' class is not draggable
    animation: 150,
  });

  // Sortable Grid List
  new Sortable(sortableGrids, {
    animation: 150,
    ghostClass: "blue-background-class",
  });

  //   Stackable Sortable Lists
  var nestedSortables = [].slice.call(document.querySelectorAll(".nested-sortable"));

  // Loop through each nested sortable element
  for (var i = 0; i < nestedSortables.length; i++) {
    new Sortable(nestedSortables[i], {
      group: "nested",
      animation: 150,
      fallbackOnBody: true,
      swapThreshold: 0.65,
    });
  }
  // Swap Lists
  new Sortable(sortableSwap, {
    swap: true, // Enable swap plugin
    swapClass: "highlight", // The class applied to the hovered swap item
    animation: 150,
  });
})();
