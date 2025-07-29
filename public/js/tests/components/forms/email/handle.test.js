import { Log } from "../../../libraries/feedback.js";

const elementName = "email";

export const HANDLE_TESTS = {
  shouldLabelHasStateFalseInEmail: () => {
    const email = document.querySelector(".email");
    const input = email.querySelector("input");
    const label = email.querySelector("[data-label-toggle]");

    input.value = "";
    input.dispatchEvent(new Event("change", { bubbles: true }));

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
  shouldLabelHasStateTrueInEmail: () => {
    const email = document.querySelector(".email");
    const input = email.querySelector("input");
    const label = email.querySelector("[data-label-toggle]");

    input.value = "123";
    input.dispatchEvent(new Event("change", { bubbles: true }));

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
