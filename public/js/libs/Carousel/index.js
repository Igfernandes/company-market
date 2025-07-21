let Carousel = function () {
  this.swiper = function ($loc = ".swiper-container", $obj) {
    if (document.querySelector(".swiper-container")) {
      const swiper = new Swiper($loc, $obj);
    }
  };

  this.bootstrap = function ($obj, $coord = ".boot-carousel") {
    if (document.querySelector($coord)) {
      document.addEventListener("DOMContentLoaded", () => {
        let carousel = document.querySelector($coord);
        let bootCarousel = new bootstrap.Carousel(carousel, $obj);
      });
    }
  };
};

const carousel = new Carousel();

const init = () => {
  carousel.swiper(".js-carousel-carteirinha", {
    slidesPerView: 1,
    spaceBetween: 20,
    effect: "flip",
    grabCursor: true,
    breakpoints: {
      700: {
        slidesPerView: 2,
        spaceBetween: 20,
        effect: "none",
        grabCursor: true,
      },
    },
  });
};

export { Carousel, init };
