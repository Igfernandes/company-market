import { Log } from "/js/tests/runtime/feedback.js";

export const INIT_TESTS = {
  ShouldCreateSearch: () => {
    const search = document.querySelector("[component='search']");
    const elementName = "search";

    if (!search)
      return Log("ERROR", {
        component: search,
        message: `O ${elementName} não foi encontrado`,
      });

    Log("SUCCESS", {
      component: elementName,
      message: `O ${elementName} foi criado com sucesso`,
    });
  },
};
