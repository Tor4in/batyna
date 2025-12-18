document.addEventListener("DOMContentLoaded", () => {
  const navLinks = document.querySelectorAll(".js-scroll-link");
  const sections = document.querySelectorAll(".js-scroll-section");
  const indicator = document.querySelector(".service-nav__indicator");
  const headerHeight = 80;
  const offset = headerHeight + 20;

  function moveIndicator(element) {
    if (!element || !indicator) return;

    const parentLi = element.parentElement;
    const parentUl = parentLi.parentElement;

    const linkRect = element.getBoundingClientRect();
    const listRect = parentUl.getBoundingClientRect();

    const top = linkRect.top - listRect.top;
    const left = linkRect.left - listRect.left;
    const width = element.offsetWidth;
    const height = element.offsetHeight;

    indicator.style.top = `${top}px`;
    indicator.style.left = `${left}px`;
    indicator.style.width = `${width}px`;
    indicator.style.height = `${height}px`;
    indicator.style.opacity = "1";
  }

  // Smooth scroll
  navLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      const targetId = this.getAttribute("href");
      const targetSection = document.querySelector(targetId);

      if (targetSection) {
        const bodyRect = document.body.getBoundingClientRect().top;
        const elementRect = targetSection.getBoundingClientRect().top;
        const elementPosition = elementRect - bodyRect;
        const offsetPosition = elementPosition - offset;

        window.scrollTo({
          top: offsetPosition,
          behavior: "smooth",
        });
      }
    });
  });

  // Scrollspy
  let isScrolling = false;

  function onScroll() {
    const scrollPos = window.pageYOffset + offset + 50;
    let current = "";

    sections.forEach((section) => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.offsetHeight;

      if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
        current = section.getAttribute("id");
      }
    });

    let activeLink = null;

    navLinks.forEach((link) => {
      link.classList.remove("is-active");
      if (current && link.getAttribute("href") === "#" + current) {
        link.classList.add("is-active");
        activeLink = link;
      }
    });

    if (activeLink) {
      moveIndicator(activeLink);
    } else {
      if (indicator) indicator.style.opacity = "0";
    }

    isScrolling = false;
  }

  window.addEventListener("scroll", () => {
    if (!isScrolling) {
      window.requestAnimationFrame(onScroll);
      isScrolling = true;
    }
  });

  window.addEventListener("resize", () => {
    onScroll();
  });

  setTimeout(onScroll, 100);
});
