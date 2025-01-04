// Wait for DOM content to load
document.addEventListener('DOMContentLoaded', () => {
  // Check if elements exist before initializing GSAP
  if (document.querySelector('.package-icon')) {
    gsap.from('.package-icon', {
      // animation properties
    });
  }

  if (document.querySelector('.text-image-video-block')) {
    ScrollTrigger.create({
      // scroll trigger properties
    });
  }
});
