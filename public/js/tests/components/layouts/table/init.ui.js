import { Log } from "../../../libraries/feedback.js";

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
};
