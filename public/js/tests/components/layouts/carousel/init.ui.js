import { Log } from "/js/tests/runtime/feedback.js";

export const INIT_TESTS = {
  ShouldCreateCarousel: () => {
    const carousel = document.querySelector('[component="carousel"]');

    if (!carousel)
      return Log("ERROR", {
        component: "carousel",
        message: "O carousel não foi encontrada",
      });

    return Log("SUCCESS", {
      component: "carousel",
      message: "O carousel foi criada com sucesso",
    });
  },
};
