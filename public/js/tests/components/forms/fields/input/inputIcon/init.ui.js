import { Log } from "/js/tests/runtime/feedback.js";

export const INIT_TESTS = {
  ShouldCreateInput: () => {
    const input = document.querySelector("[component='input-icon']");
    const elementName = "input";

    if (!input)
      return Log("ERROR", {
        component: elementName,
        message: `O ${elementName} não foi encontrado`,
      });

    Log("SUCCESS", {
      component: elementName,
      message: `O ${elementName} foi criado com sucesso`,
    });
  },
};
