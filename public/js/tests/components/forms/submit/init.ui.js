import { Log } from "../../../libraries/feedback.js";

export const INIT_TESTS = {
  ShouldCreateSubmit: () => {
    const submit = document.querySelector("[component='submit']");

    if (!submit)
      return Log("ERROR", {
        component: "submit",
        message: "O botão de submit não foi encontrado",
      });

    return Log("SUCCESS", {
      component: "submit",
      message: "O botão de submit foi criado com sucesso",
    });
  },
};
