import { Log } from "../../../libraries/feedback.js";

export const HANDLE_TESTS = {
  ShouldCreateCheckbox: () => {
    const checkbox = document.querySelector(".checkbox");

    if (!checkbox)
      return Log("ERROR", {
        component: "checkbox",
        message: "O checkbox não foi encontrado",
      });

    return Log("SUCCESS", {
      component: "checkbox",
      message: "O checkbox foi criado com sucesso",
    });
  },
  shouldCheckboxBeUnChecked: () => {
    const checkbox = document.querySelector(".checkbox");
    const input = checkbox.querySelector("input");

    input.checked = false;
    input.dispatchEvent(new Event("change", { bubbles: true }));

    if (input.checked !== false) {
      return Log("ERROR", {
        component: "checkbox",
        message: `O checkbox não alterou o estado`,
      });
    }

    return Log("SUCCESS", {
      component: "checkbox",
      message: `O checkbox alterou para não checado com sucesso`,
    });
  },
  shouldCheckboxBeChecked: () => {
    const checkbox = document.querySelector(".checkbox");
    const input = checkbox.querySelector("input");

    input.checked = true;
    input.dispatchEvent(new Event("change", { bubbles: true }));

    if (input.checked !== true) {
      return Log("ERROR", {
        component: "checkbox",
        message: `O checkbox não alterou o estado`,
      });
    }

    return Log("SUCCESS", {
      component: "checkbox",
      message: `O checkbox alterou para checado com sucesso`,
    });
  }
};
