import { Log } from "/js/tests/runtime/feedback.js";

const elementName = "email";

export const HANDLE_TESTS = {
  shouldEmptyInInput: () => {
    const email = document.querySelector("[component='email-icon']");
    const emailField = email.querySelector("input");

    if (!emailField) {
      return Log("ERROR", {
        component: elementName,
        message: `O ${elementName} não consegue alterar para ''`,
      });
    }

    emailField.value = "";
    emailField.dispatchEvent(new Event("change", { bubbles: true }));

    return Log("SUCCESS", {
      component: elementName,
      message: `O ${elementName} alterou para ''`,
    });
  },
  shouldWriteInInput: () => {
    const email = document.querySelector("[component='email-icon']");
    const emailField = email.querySelector("input");

    if (!emailField) {
      return Log("ERROR", {
        component: elementName,
        message: `O ${elementName} não consegue alterar para 123`,
      });
    }

    emailField.value = "123";
    emailField.dispatchEvent(new Event("change", { bubbles: true }));

    return Log("SUCCESS", {
      component: elementName,
      message: `O ${elementName} alterou para 123`,
    });
  },
};
