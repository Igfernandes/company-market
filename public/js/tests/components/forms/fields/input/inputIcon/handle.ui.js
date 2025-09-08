import { Log } from "/js/tests/runtime/feedback.js";

const elementName = "input";

export const HANDLE_TESTS = {
  shouldEmptyInInput: () => {
    const input = document.querySelector("[component='input-icon']");
    const inputField = input.querySelector("input");

    if (!inputField) {
      return Log("ERROR", {
        component: elementName,
        message: `O ${elementName} não consegue alterar para ''`,
      });
    }

    inputField.value = "";
    inputField.dispatchEvent(new Event("change", { bubbles: true }));

    return Log("SUCCESS", {
      component: elementName,
      message: `O ${elementName} alterou para ''`,
    });
  },
  shouldWriteInInput: () => {
    const input = document.querySelector("[component='input-icon']");
    const inputField = input.querySelector("input");

    if (!inputField) {
      return Log("ERROR", {
        component: elementName,
        message: `O ${elementName} não consegue alterar para 123`,
      });
    }

    inputField.value = "123";
    inputField.dispatchEvent(new Event("change", { bubbles: true }));

    return Log("SUCCESS", {
      component: elementName,
      message: `O ${elementName} alterou para 123`,
    });
  },
};
