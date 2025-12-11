import Swiper from "swiper";
import { Navigation } from "swiper/modules";

document.addEventListener("DOMContentLoaded", () => {
  const sliderSelector = ".doctors-swiper";
  const sliderElement = document.querySelector(sliderSelector);

  if (!sliderElement) return;

  const doctorsSwiper = new Swiper(sliderSelector, {
    modules: [Navigation],
    slidesPerView: 1,
    spaceBetween: 20, 
    speed: 600,
    grabCursor: true,
    watchSlidesProgress: true, 
    navigation: {
      prevEl: ".doctors-slider-nav .slider-nav__prev",
      nextEl: ".doctors-slider-nav .slider-nav__next",
    },
    breakpoints: {
      768: {
        slidesPerView: 1,
        spaceBetween: 20,
      },
      
      992: {
        slidesPerView: 2,
        spaceBetween: 20, 
      },
    },
  });
});
