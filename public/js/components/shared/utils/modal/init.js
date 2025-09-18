import { handleToggleModal } from "./core/handles.js";

export const init = () => {
  const btnModals = Array.from(document.querySelectorAll("[modal-target]"));

  btnModals.forEach((btnModal) =>
    btnModal.addEventListener("click", handleToggleModal)
  );
};
