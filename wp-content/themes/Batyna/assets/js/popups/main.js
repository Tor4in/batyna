import { Popup } from "./class";
import { updateHeaderHeight } from "../components/header";

export function initPopups() {
  const burgerSelector = ".js-toggle-mobile-menu";
  const mobileMenuEl = document.querySelector("#mobile-menu");
  const burgerButton = document.querySelector(burgerSelector);

  if (mobileMenuEl && burgerButton) {
    updateHeaderHeight();

    new Popup("#mobile-menu", {
      toggleButtons: burgerSelector,
      closeButton: ".js-close-popup",
      on: {
        open: () => {
          document.body.style.overflow = "hidden";
          burgerButton.classList.add("is-active");
        },
        close: () => {
          document.body.style.overflow = "";
          burgerButton.classList.remove("is-active");
        },
      },
    });

    burgerButton.addEventListener("click", updateHeaderHeight);
  }
}

initPopups();
