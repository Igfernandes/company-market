import { Log } from "../../../../libraries/feedback.js";
import { hasElementsInComponent } from "../../../../libraries/validations/has.js";

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

    if (
      !hasElementsInComponent(
        [
          `[component="${elementName}:label"]`,
          `[component="${elementName}:visibility"]`,
        ],
        password
      )
    )
      return;

    if (hasError) return;

    Log("SUCCESS", {
      component: elementName,
      message: `O ${elementName} foi criado com sucesso`,
    });
  },
};
