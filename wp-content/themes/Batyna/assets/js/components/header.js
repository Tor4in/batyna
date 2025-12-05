/**
 * Header scroll control & CSS variable calculation
 */

const header = document.querySelector(".header");
const scrollThreshold = 50;
let lastScrollTop = 0;

/**
 * Calculates header height and sets CSS variables.
 * Called on load and resize.
 */
export function updateHeaderHeight() {
  if (!header) return;

  const height = header.getBoundingClientRect().height;

  // Set header height variable for backdrop positioning
  document.documentElement.style.setProperty("--header-height", `${height}px`);
}

function updateHeaderOnScroll() {
  if (!header) return;

  const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  const isMenuOpen = document
    .querySelector("#mobile-menu")
    ?.hasAttribute("open");

  // Toggle shadow class
  if (scrollTop > 10) {
    header.classList.add("header-scrolled");
  } else {
    header.classList.remove("header-scrolled");
  }

  // Always show header at top or if menu is open
  if (scrollTop <= scrollThreshold || isMenuOpen) {
    header.classList.remove("header-hidden");
    header.classList.add("header-visible");
    lastScrollTop = scrollTop;
    return;
  }

  // Scroll Down -> Hide, Scroll Up -> Show
  if (scrollTop > lastScrollTop && scrollTop > scrollThreshold) {
    header.classList.add("header-hidden");
    header.classList.remove("header-visible");
  } else if (scrollTop < lastScrollTop) {
    header.classList.remove("header-hidden");
    header.classList.add("header-visible");
  }

  lastScrollTop = scrollTop;
}

export function initHeader() {
  if (!header) return;

  updateHeaderHeight();
  updateHeaderOnScroll();

  window.addEventListener("scroll", updateHeaderOnScroll, { passive: true });
  window.addEventListener("resize", updateHeaderHeight);
}
