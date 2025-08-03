import { Log } from "../../../../libraries/feedback.js";

const elementName = "password-toggle";

export const HANDLE_TESTS = {
  shouldShowContentPassword: () => {
    const password = document.querySelector(".password-toggle");
    const input = password.querySelector("input");
    const eyeElement = password.querySelector("[data-password-visibility]");

    eyeElement.click();

    if (input.type === "password") {
      return Log("ERROR", {
        component: elementName,
        message: `O ${elementName} não alterou o estado de 'password' para 'text'`,
      });
    }

    return Log("SUCCESS", {
      component: elementName,
      message: `O ${elementName} alterou o estado do input para 'text' com sucesso`,
    });
  },
  shouldHiddenContentPassword: () => {
    const password = document.querySelector(".password-toggle");
    const input = password.querySelector("input");
    const eyeElement = password.querySelector("[data-password-visibility]");

    eyeElement.click();

    if (input.type === "text") {
      return Log("ERROR", {
        component: elementName,
        message: `O ${elementName} não alterou o estado de 'text' para 'password'`,
      });
    }

    return Log("SUCCESS", {
      component: elementName,
      message: `O ${elementName} alterou o estado do input para 'password' com sucesso`,
    });
  },
  shouldLabelHasStateFalseInPassword: () => {
    const password = document.querySelector(".password-toggle");
    const input = password.querySelector("input");
    const label = password.querySelector("[data-label-toggle]");

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
  shouldLabelHasStateTrueInPassword: () => {
    const password = document.querySelector(".password-toggle");
    const input = password.querySelector("input");
    const label = password.querySelector("[data-label-toggle]");

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
