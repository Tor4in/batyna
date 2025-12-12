import Swiper from "swiper";
import { Navigation } from "swiper/modules";

document.addEventListener("DOMContentLoaded", () => {
  const sliderSelector = ".advantages-swiper";

  if (!document.querySelector(sliderSelector)) return;

  const advantagesSwiper = new Swiper(sliderSelector, {
    modules: [Navigation],
    slidesPerView: "auto", 
    spaceBetween: 10,
    speed: 600,
    grabCursor: true,
    navigation: {
      prevEl: ".slider-nav__prev",
      nextEl: ".slider-nav__next",
    },
    breakpoints: {
      992: {
        enabled: false,
        allowTouchMove: false,
      },
    },
  });
});