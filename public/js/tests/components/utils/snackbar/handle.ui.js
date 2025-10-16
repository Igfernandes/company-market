import { Log } from "/js/tests/runtime/feedback.js";

export const HANDLE_TESTS = {
  ShouldCloseSnackbar: () => {
    const snackbar = document.querySelector("[component='snackbar']");
    const closeButton = snackbar.querySelector(
      "[component='snackbar:close']"
    );

    if (!snackbar || !closeButton)
      return Log("ERROR", {
        component: "snackbar",
        message: "O snackbar ou o botão de fechar não foram encontrados",
      });

    closeButton.click();

    const snackbarAfterEventClick = document.querySelector(
      "[component='snackbar']"
    );
    if (snackbarAfterEventClick) {
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
