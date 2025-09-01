import { Log } from "/js/tests/runtime/feedback.js";

const elementName = "date";

export const HANDLE_TESTS = {
  shouldEmptyInDateInput: () => {
    const date = document.querySelector("[component='date-icon']");
    const dateField = date.querySelector("input");

    dateField.value = "a";
    dateField.dispatchEvent(new Event("change", { bubbles: true }));
    dateField.dispatchEvent(new Event("keyup", dateField));

    if (dateField.value !== "") {
      return Log("ERROR", {
        component: elementName,
        message: `O ${elementName} alterou para um valor, que não seja data`,
      });
    }

    dateField.value = "";

    return Log("SUCCESS", {
      component: elementName,
      message: `O ${elementName} impediu um valor, que não seja data`,
    });
  },
  shouldWriteInDateInput: () => {
    const date = document.querySelector("[component='date-icon']");
    const dateField = date.querySelector("input");

    dateField.value = "11/11/1111";
    dateField.dispatchEvent(new Event("change", { bubbles: true }));
    dateField.dispatchEvent(new Event("keyup", { bubbles: true }));

    if (dateField.value === "11/11/1111") {
      return Log("SUCCESS", {
        component: elementName,
        message: `O ${elementName} permitiu o formato de data`,
      });
    }

    dateField.value = "";

    return Log("ERROR", {
      component: elementName,
      message: `O ${elementName} não permitiu o formato de data`,
    });
  },
};
