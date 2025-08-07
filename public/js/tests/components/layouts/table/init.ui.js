import { Log } from "../../../libraries/feedback.js";
import { hasAttributesInElement } from "../../../libraries/validations/has.js";

export const INIT_TESTS = {
  ShouldCreateTable: () => {
    const table = document.querySelector("[component='table']");

    if (!table)
      return Log("ERROR", {
        component: "table",
        message: "A tabela não foi encontrada",
      });

    return Log("SUCCESS", {
      component: "table",
      message: "A tabela foi criada com sucesso",
    });
  },
  ShouldAllAttributesInTable: () => {
    const table = document.querySelector("[component='table']");
    const elementName = "table";

    if (
      !hasAttributesInElement(["data-heads", "data-ajax", "data-test"], table)
    )
      return;

    Log("SUCCESS", {
      component: elementName,
      message: `O ${elementName} foi criado com sucesso`,
    });
  },
};
