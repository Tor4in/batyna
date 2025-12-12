import Swiper from "swiper";

document.addEventListener("DOMContentLoaded", () => {
  const sliderSelector = ".blog-section__swiper";

  if (!document.querySelector(sliderSelector)) return;

  const blogSwiper = new Swiper(sliderSelector, {
    slidesPerView: 1.1, 
    spaceBetween: 10,
    speed: 600,
    grabCursor: true,
  });
});