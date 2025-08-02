import { Log } from "../../../libraries/feedback.js";

export const HANDLE_TESTS = {
  ShouldCreateImage: () => {
    const image = document.querySelector('img');

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
