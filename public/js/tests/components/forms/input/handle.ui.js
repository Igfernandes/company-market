import { Log } from "../../../libraries/feedback.js";

const elementName = "email";

export const HANDLE_TESTS = {
  shouldLabelHasStateFalseInInput: () => {
    const input = document.querySelector("[component='input']");
    const inputField = input.querySelector("input");
    const label = input.querySelector("[data-label-toggle]");

    inputField.value = "";
    inputField.dispatchEvent(new Event("change", { bubbles: true }));

    if (label.getAttribute("data-label-toggle") != "false") {
      return Log("ERROR", {
        component: elementName,
        message: `O ${elementName} não alterou o estado do label`,
      });
    }

    return Log("SUCCESS", {
      component: elementName,
      message: `O ${elementName} alterou o estado do label 'true' com sucesso`,
    });
  },
  shouldLabelHasStateTrueInInput: () => {
    const input = document.querySelector("[component='input']");
    const inputField = input.querySelector("input");
    const label = input.querySelector("[data-label-toggle]");

    inputField.value = "123";
    inputField.dispatchEvent(new Event("change", { bubbles: true }));

    if (label.getAttribute("data-label-toggle") === "false") {
      return Log("ERROR", {
        component: elementName,
        message: `O ${elementName} não alterou o estado do label`,
      });
    }

    return Log("SUCCESS", {
      component: elementName,
      message: `O ${elementName} alterou o estado do label para 'false' com sucesso`,
    });
  },
};
