import { Log } from "../../../../libraries/feedback.js";

export const INIT_TESTS = {
  ShouldCreatePassword: () => {
    const password = document.querySelector("[component='password-toggle']");
    const elementName = "password-toggle";

    if (!password)
      return Log("ERROR", {
        component: elementName,
        message: `O ${elementName} não foi encontrado`,
      });

    Log("SUCCESS", {
      component: elementName,
      message: `O ${elementName} foi criado com sucesso`,
    });
  },
  ShouldExistsElementsInPassword: () => {
    const password = document.querySelector("[component='password-toggle']");
    let hasError = false;
    const elementName = "password-toggle";

    ["label", "visibility"].forEach((param) => {
      const hasElementInPassword = password.querySelector(
        `[data-component="${elementName}:${param}"]`
      );
      if (!hasElementInPassword) {
        Log("ERROR", {
          component: elementName,
          message: `O elemento ${param} do p${elementName} não pode ser encontrado`,
        });
        hasError = true;
      }
    });

    if (hasError) return;

    Log("SUCCESS", {
      component: elementName,
      message: `O ${elementName} foi criado com sucesso`,
    });
  },
};
