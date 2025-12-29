export default function scrollTop() {
  const btn = document.querySelector('.btn-scroll-top');

  if (!btn) return;

  const handleScroll = () => {
    if (window.scrollY > window.innerHeight / 2) {
      btn.classList.add('is-visible');
    } else {
      btn.classList.remove('is-visible');
    }
  };

  const scrollToTop = () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth',
    });
  };

  window.addEventListener('scroll', handleScroll, { passive: true });
  btn.addEventListener('click', scrollToTop);
}