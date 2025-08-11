import { Log } from "/js/tests/runtime/feedback.js";

export const INIT_TESTS = {
  ShouldCreateModal: () => {
    const modal = document.querySelector("[component='modal']");
    let hasError = false;

    if (!modal)
      return Log("ERROR", {
        component: "modal",
        message: "O modal não foi encontrado",
      });

    ["title", 'subtitle', "close"].forEach((param) => {
      const hasElementInModal = modal.querySelector(
        `[data-component="modal:${param}"]`
      );
      if (!hasElementInModal) {
        Log("ERROR", {
          component: "modal",
          message: `O elemento ${param} do modal não pode ser encontrado`,
        });
        hasError = true;
      }
    });

    if (hasError) return;

    Log("SUCCESS", {
      component: "modal",
      message: "O modal foi criado com sucesso",
    });
  },
};
