import { Log } from "/js/tests/runtime/feedback.js";
import { hasAttributesInElement } from "/js/tests/runtime/validations/has.js";

export const INIT_TESTS = {
  ShouldCreateTabs: () => {
    const table = document.querySelector("[component='tabs']");

    if (!table)
      return Log("ERROR", {
        component: "tab",
        message: "A tab não foi encontrada",
      });

    return Log("SUCCESS", {
      component: "tab",
      message: "A tab foi criada com sucesso",
    });
  },
  ShouldAllAttributesInTabs: () => {
    const table = document.querySelector("[component='tabs-header']");
    const elementName = "tab";

    if (
      !hasAttributesInElement(
        ["component='tabs-header'", "tab-target", "tab"],
        table
      )
    )
      return;

    Log("SUCCESS", {
      component: elementName,
      message: `O ${elementName} foi criado com sucesso`,
    });
  },
};
