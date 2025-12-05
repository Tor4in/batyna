import "./utils";
import "./events/main";

// Header Component
if (document.querySelector(".header")) {
  import("./components/header")
    .then((module) => {
      module.initHeader();
    })
    .catch((error) => {
      console.error("Failed to load Header module:", error);
    });
}

// Swipers
if (document.querySelector(".swiper")) {
  import("./swipers/main").catch((error) => {
    console.error("Failed to load Swiper module:", error);
  });
}

// Popups & Mobile Menu
if (
  document.querySelector(".backdrop") ||
  document.querySelector("[data-popup]")
) {
  import("./popups/main").catch((error) => {
    console.error("Failed to load Popups module:", error);
  });
}

import "../css/main.scss";
