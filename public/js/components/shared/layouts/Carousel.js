export const init = () => {
  const carousels = document.querySelectorAll("[data-component='carousel']");

  carousels.forEach((carousel) => {
    const settingsString = carousel.getAttribute("carousel-settings");
    let settings = {
      spaceBetween: 30,
      effect: "fade",
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

    new Swiper(`#${carousel.id}`, settings);
  });
};
