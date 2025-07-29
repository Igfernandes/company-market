import { Log } from "../../../libraries/feedback.js";

export const INIT_TESTS = {
  ShouldCreateEmail: () => {
    const email = document.querySelector(".email");
    let hasError = false;
    const elementName = "email";

    if (!email)
      return Log("ERROR", {
        component: elementName,
        message: `O ${elementName} não foi encontrado`,
      });

    const hasElementInEmail = email.querySelector(
      `[data-component="${elementName}:label"]`
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
