import { Log } from "/js/tests/runtime/feedback.js";

export const HANDLE_TESTS = {
  ShouldCloseModal: () => {
    const modal = document.querySelector("[component='modal']");
    const closeButton = modal.querySelector(
      "[data-component='modal:close']"
    );

    if (!modal || !closeButton)
      return Log("ERROR", {
        component: "modal",
        message: "O modal ou o botão de fechar não foram encontrados",
      });

    closeButton.click();

    const modalAfterEventClick = document.querySelector(
      "[component='modal']"
    );
    if (modalAfterEventClick) {
      return Log("ERROR", {
        component: "modal",
        message: "O modal não foi fechado corretamente",
      });
    }

    return Log("SUCCESS", {
      component: "modal",
      message: "O modal foi fechado com sucesso",
    });
  },
};
