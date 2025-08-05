import { Log } from "../../../libraries/feedback.js";

export const INIT_TESTS = {
  ShouldCreateInput: () => {
    const input = document.querySelector("[component='input']");
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
  ShouldAllProprietiesInInput: () => {
    const input = document.querySelector("[component='input']");
    let hasError = false;
    const elementName = "input";

    const hasElementInInput = input.querySelector(
      `[component="${elementName}:label"]`
    );
    if (!hasElementInInput) {
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
