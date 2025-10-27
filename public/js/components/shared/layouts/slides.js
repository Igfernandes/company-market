export const init = () => {
  const slides = document.querySelectorAll(
    "[component='slides'] [component='slides:container']"
  );

  slides.forEach((slide) => {
    const settingsString = slide.getAttribute("slides-settings");
    let settings = {
      spaceBetween: 30,
      effect: "slide",
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
    };

    if (settingsString) {
      const customSettings = JSON.parse(settingsString);

      settings = {
        ...settings,
        ...customSettings,
      };
    }

    const swiper = new Swiper(`#${slide.id}`, settings);
    if (!window.slides) window.slides = {};
    window.slides[slide.id] = swiper;
  });
};
