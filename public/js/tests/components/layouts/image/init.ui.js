import { Log } from "../../../libraries/feedback.js";

export const INIT_TESTS = {
  ShouldCreateImage: () => {
    const image = document.querySelector("[component='image']");

    if (!image)
      return Log("ERROR", {
        component: "image",
        message: "A imagem não foi encontrada",
      });

    return Log("SUCCESS", {
      component: "image",
      message: "A imagem foi criada com sucesso",
    });
  },
};
