const header = document.querySelector(".header");

export function updateHeaderHeight() {
  if (!header) return;

  const height = header.getBoundingClientRect().height;
  document.documentElement.style.setProperty("--header-height", `${height}px`);
}

export function initHeader() {
  if (!header) return;

  updateHeaderHeight();
  window.addEventListener("resize", updateHeaderHeight);
}
