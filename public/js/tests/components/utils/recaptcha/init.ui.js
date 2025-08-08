import { Log } from "/js/tests/runtime/feedback.js";

export const INIT_TESTS = {
  ShouldCreateRecaptcha: () => {
    const recaptcha = document.querySelector(".recaptcha") 

    if (!recaptcha)
      return Log("ERROR", {
        component: "recaptcha",
        message: "O recaptcha não foi encontrado",
      });

    ["h-captcha", "describe"].forEach((param) => {
      const hasElementInRecaptcha = recaptcha.querySelector(
        `.${param}`
      );
      if (!hasElementInRecaptcha) {
        Log("ERROR", {
          component: "recaptcha",
          message: `O elemento ${param} do recaptcha não pode ser encontrado`,
        });
      }
    });

    return Log("SUCCESS", {
      component: "recaptcha",
      message: "O recaptcha foi criado com sucesso",
    });
  },
};
