import { translate } from "../../../../translate/index.js";
import { Component } from "../../../../helpers/components.js";
import { deleteUser } from "../../../../services/users/delete.js";
import { handleDeleteModal } from "../../../../components/shared/utils/modal/handle.js";

const modal = await Component("modal", {
  type: "user_delete",
  title: translate("Screens.users.delete.modal_title"),
  subtitle: translate("Screens.users.delete.modal_subtitle"),
  content: translate("Screens.users.delete.modal_text"),
  left: "Cancelar",
  right: "Deletar",
});

export function UserDeleteForm() {
  this.handleClick = async (ev) => {
    const btn = ev.target;
    const userId = btn.getAttribute("data-delete-key");

    modal.classList.remove("hidden");
    document.body.append(modal);

    const cancelBtn = modal.querySelector("[component='modal:left-btn']");
    cancelBtn.addEventListener("click", handleDeleteModal);
    const confirmBtn = modal.querySelector("[component='modal:right-btn']");
    confirmBtn.addEventListener("click", async () => {
      const { success } = deleteUser({
        id: userId,
      });

      if (success) modal.remove();
    });
  };
}
