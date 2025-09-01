import { Log } from "/js/tests/runtime/feedback.js";

export const INIT_TESTS = {
  ShouldCreateDateInput: () => {
    const phone = document.querySelector("[component='phone']");
    const elementName = "phone";

    if (!phone)
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
