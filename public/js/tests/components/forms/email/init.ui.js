import { Log } from "../../../libraries/feedback.js";

export const INIT_TESTS = {
  ShouldCreateEmail: () => {
    const email = document.querySelector("[component='email']");
    const elementName = "email";

    if (!email)
      return Log("ERROR", {
        component: elementName,
        message: `O ${elementName} não foi encontrado`,
      });

    Log("SUCCESS", {
      component: elementName,
      message: `O ${elementName} foi criado com sucesso`,
    });
  },
  ShouldExistLabelElementInEmail: () => {
    const email = document.querySelector("[component='email']");
    let hasError = false;
    const elementName = "email";

    const hasElementInEmail = email.querySelector(
      `[component="${elementName}:label"]`
    );
    if (!hasElementInEmail) {
      Log("ERROR", {
        component: elementName,
        message: `O elemento label do ${elementName} não pode ser encontrado`,
      });
      hasError = true;
    }

    if (hasError) return;

    Log("SUCCESS", {
      component: elementName,
      message: `O ${elementName} foi criado com sucesso`,
    });
  },
};
