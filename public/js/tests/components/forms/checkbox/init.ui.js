import { Log } from "../../../libraries/feedback.js";

export const INIT_TESTS = {
  ShouldCreateCheckbox: () => {
    const checkbox = document.querySelector("[component='checkbox']");

    if (!checkbox)
      return Log("ERROR", {
        component: "checkbox",
        message: "O checkbox não foi encontrado",
      });

    return Log("SUCCESS", {
      component: "checkbox",
      message: "O checkbox foi criado com sucesso",
    });
  },
};
