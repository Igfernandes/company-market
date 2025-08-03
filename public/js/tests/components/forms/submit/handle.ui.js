import { Log } from "../../../libraries/feedback.js";

export const HANDLE_TESTS = {
  ShouldCreateSubmit: () => {
    const submit = document.querySelector('.submit');

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
