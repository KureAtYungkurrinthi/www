"use strict";
// Function to toggle the dropdown
function toggleDropdown() {
  document.getElementById("myDropdown").classList.toggle("show");
}

document.querySelector(".account").addEventListener("click", toggleDropdown);

window.addEventListener("click", function (event) {
  if (!event.target.matches(".account")) {
    let dropdowns = document.getElementsByClassName("dropdown-content");
    let i;
    for (i = 0; i < dropdowns.length; i++) {
      let openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("show")) {
        openDropdown.classList.remove("show");
      }
    }
  }
});
