import { Log } from "../../../libraries/feedback.js";

export const HANDLE_TESTS = {
  ShouldCreateSnackbar: () => {
    const snackbar = document.querySelector(".snackbar");
    let hasError = false;

    if (!snackbar)
      return Log("ERROR", {
        component: "snackbar",
        message: "O snackbar não foi encontrado",
      });

    ["title", "message", "close"].forEach((param) => {
      const hasElementInSnackbar = snackbar.querySelector(
        `[data-component="snackbar:${param}"]`
      );
      if (!hasElementInSnackbar) {
        Log("ERROR", {
          component: "snackbar",
          message: `O elemento ${param} do snackbar não pode ser encontrado`,
        });
        hasError = true;
      }
    });

    if (hasError) return;

    Log("SUCCESS", {
      component: "snackbar",
      message: "O snackbar foi criado com sucesso",
    });
  },
  ShouldCloseSnackbar: () => {
    const snackbar = document.querySelector(".snackbar");
    const closeButton = snackbar.querySelector("[data-component='snackbar:close']");

    if (!snackbar || !closeButton)
      return Log("ERROR", {
        component: "snackbar",
        message: "O snackbar ou o botão de fechar não foram encontrados",
      });

    closeButton.click();

    const snackbarClosed = document.querySelector(".snackbar");

    if (snackbarClosed) {
      return Log("ERROR", {
        component: "snackbar",
        message: "O snackbar não foi fechado corretamente",
      });
    }

    return Log("SUCCESS", {
      component: "snackbar",
      message: "O snackbar foi fechado com sucesso",
    });
  },
};
