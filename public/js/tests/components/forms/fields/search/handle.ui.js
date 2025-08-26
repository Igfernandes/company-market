import { Log } from "/js/tests/runtime/feedback.js";

const elementName = "search";

export const HANDLE_TESTS = {
  shouldWriteInSearch: () => {
    const search = document.querySelector("[component='search']");
    console.log(search.querySelector("#search"))
    const searchField = search.querySelector("#search");
    
    if (!searchField) {
      return Log("ERROR", {
        component: elementName,
        message: `O ${elementName} não consegue alterar para 123`,
      });
    }

    searchField.value = "123";
    searchField.dispatchEvent(new Event("change", { bubbles: true }));

    return Log("SUCCESS", {
      component: elementName,
      message: `O ${elementName} alterou para 123`,
    });
  },
  shouldEmptyInInput: () => {
    const search = document.querySelector("[component='search']");
    const searchField = search.querySelector("#search");

    if (!searchField) {
      return Log("ERROR", {
        component: elementName,
        message: `O ${elementName} não consegue alterar para ''`,
      });
    }

    searchField.value = "";
    searchField.dispatchEvent(new Event("change", { bubbles: true }));

    return Log("SUCCESS", {
      component: elementName,
      message: `O ${elementName} alterou para ''`,
    });
  },
};
