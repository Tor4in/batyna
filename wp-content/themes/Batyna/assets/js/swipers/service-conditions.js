import Swiper from "swiper";
import { Navigation } from "swiper/modules";

document.addEventListener("DOMContentLoaded", () => {
  const sliderSelector = ".conditions-swiper";
  const sliderElement = document.querySelector(sliderSelector);

  if (sliderElement) {
    const conditionsSwiper = new Swiper(sliderSelector, {
      modules: [Navigation],
      // Mobile settings (default)
      slidesPerView: 1,
      spaceBetween: 20,
      loop: true,
      speed: 600,
      grabCursor: true,
      navigation: {
        prevEl: ".conditions-nav-wrapper .slider-nav__prev",
        nextEl: ".conditions-nav-wrapper .slider-nav__next",
      },
      // Desktop breakpoint (> 992px)
      breakpoints: {
        992: {
          slidesPerView: "auto",
          spaceBetween: 20,
        },
      },
    });
  }
});
