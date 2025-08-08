import { Log } from "/js/tests/runtime/feedback.js";

export const INIT_TESTS = {
  ShouldCreateSnackbar: () => {
    const snackbar = document.querySelector("[component='snackbar']");
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
};
