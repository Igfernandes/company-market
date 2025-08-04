import { Log } from "../../../libraries/feedback.js";

export const INIT_TESTS = {
  ShouldCreateLink: () => {
    const link = document.querySelector("[component='link']");
    const elementName = "link";

    if (!link)
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
