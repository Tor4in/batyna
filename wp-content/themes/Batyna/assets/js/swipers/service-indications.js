import Swiper from "swiper";
import { Navigation } from "swiper/modules";

document.addEventListener("DOMContentLoaded", () => {
  // Swiper initialization
  const sliderSelector = ".indications-swiper";
  const sliderElement = document.querySelector(sliderSelector);

  if (sliderElement) {
    const indicationsSwiper = new Swiper(sliderSelector, {
      modules: [Navigation],
      slidesPerView: 1,
      spaceBetween: 0,
      speed: 600,
      grabCursor: true,
      watchSlidesProgress: true,
      autoHeight: false,
      navigation: {
        prevEl: ".indications-nav-wrapper .slider-nav__prev",
        nextEl: ".indications-nav-wrapper .slider-nav__next",
      },
      on: {
        slideChange: function () {
          pauseAllVideos(null);
        },
      },
    });
  }

  // Video controls
  const videoWrappers = document.querySelectorAll(".js-video-wrapper");

  function pauseAllVideos(excludeVideo) {
    videoWrappers.forEach((wrapper) => {
      const video = wrapper.querySelector("video");
      if (video && video !== excludeVideo && !video.paused) {
        video.pause();
        wrapper.classList.remove("is-playing");

        const sliderWrapper = wrapper.closest(
          ".service-indications__slider-wrapper"
        );
        if (sliderWrapper) sliderWrapper.classList.remove("video-playing");
      }
    });
  }

  if (videoWrappers.length) {
    videoWrappers.forEach((wrapper) => {
      const video = wrapper.querySelector(".js-video-element");
      const playBtn = wrapper.querySelector(".js-video-play-btn");
      const cover = wrapper.querySelector(".js-video-cover");

      if (video) {
        video.classList.add("swiper-no-swiping");
      }

      if (!video) return;

      const playVideo = () => {
        pauseAllVideos(video);
        video.controls = true;
        video.play().catch((err) => console.error("Play error:", err));
        wrapper.classList.add("is-playing");

        const sliderWrapper = wrapper.closest(
          ".service-indications__slider-wrapper"
        );
        if (sliderWrapper) sliderWrapper.classList.add("video-playing");
      };

      if (playBtn) {
        playBtn.addEventListener("click", (e) => {
          e.stopPropagation();
          playVideo();
        });
      }

      if (cover) {
        cover.addEventListener("click", (e) => {
          if (playBtn && !playBtn.contains(e.target) && e.target !== playBtn) {
            playVideo();
          }
        });
      }

      video.addEventListener("click", (e) => {
        e.stopPropagation();
        if (video.paused) {
          video.play();
        } else {
          video.pause();
        }
      });

      video.addEventListener("play", () => {
        wrapper.classList.add("is-playing");
        const sliderWrapper = wrapper.closest(
          ".service-indications__slider-wrapper"
        );
        if (sliderWrapper) sliderWrapper.classList.add("video-playing");
      });

      video.addEventListener("pause", () => {
        if (!video.seeking && !video.ended) {
          wrapper.classList.remove("is-playing");
          video.controls = false;

          const sliderWrapper = wrapper.closest(
            ".service-indications__slider-wrapper"
          );
          if (sliderWrapper) sliderWrapper.classList.remove("video-playing");
        }
      });

      video.addEventListener("ended", () => {
        wrapper.classList.remove("is-playing");
        video.controls = false;
        video.currentTime = 0;

        const sliderWrapper = wrapper.closest(
          ".service-indications__slider-wrapper"
        );
        if (sliderWrapper) sliderWrapper.classList.remove("video-playing");
      });
    });
  }
});
