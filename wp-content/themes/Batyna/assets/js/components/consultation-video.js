import { load } from "../events/load";

load(() => {
  const videoWrappers = document.querySelectorAll(".js-video-wrapper");
  if (!videoWrappers.length) return;

  videoWrappers.forEach((wrapper) => {
    const video = wrapper.querySelector(".js-video-element");
    const playBtn = wrapper.querySelector(".js-video-play-btn");
    const cover = wrapper.querySelector(".js-video-cover");

    if (!video) return;

    // Start video
    const playVideo = () => {
      video.controls = true;
      video.play().catch((err) => console.error("Play error:", err));
    };

    // Play button click
    if (playBtn) {
      playBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        playVideo();
      });
    }

    // Cover click
    if (cover) {
      cover.addEventListener("click", (e) => {
        if (playBtn && !playBtn.contains(e.target) && e.target !== playBtn) {
          playVideo();
        }
      });
    }

    // State classes
    video.addEventListener("play", () => {
      wrapper.classList.add("is-playing");
    });

    video.addEventListener("pause", () => {
      if (!video.seeking) {
        wrapper.classList.remove("is-playing");
        video.controls = false;
      }
    });

    video.addEventListener("ended", () => {
      wrapper.classList.remove("is-playing");
      video.controls = false;
    });
  });
});
