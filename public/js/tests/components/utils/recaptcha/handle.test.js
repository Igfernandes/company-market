import { Log } from "../../../libraries/feedback.js";

export const HANDLE_TESTS = {
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
  ShouldClickRecaptcha: () => {
    const recaptcha = document.querySelector("[data-component='recaptcha']");

    if (recaptcha) {
      console.log(hcaptcha.execute())
    }

    return Log("SUCCESS", {
      component: "recaptcha",
      message: "O recaptcha foi clicado com sucesso",
    });
  },
};
