import { translate } from "../../../../translate/index.js";
import { Component } from "../../../../helpers/components.js";
import { deleteUser } from "../../../../services/users/delete.js";
import { handleDeleteModal } from "../../../../components/shared/utils/modal/handle.js";
import { handleReloadTable } from "../../../../components/shared/layouts/table/utils/handle.js";
import { getDeleteKey } from "../../../../components/shared/layouts/table/utils/target.js";

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
    const userId = getDeleteKey(btn);

    modal.classList.remove("hidden");
    document.body.append(modal);

    const cancelBtn = modal.querySelector("[component='modal:left-btn']");
    cancelBtn.addEventListener("click", handleDeleteModal);
    const confirmBtn = modal.querySelector("[component='modal:right-btn']");
    confirmBtn.addEventListener("click", async () => {
      const { success } = await deleteUser({
        id: userId,
      });

      if (success) {
        handleReloadTable("users");
        modal.remove();
      }
    });
  };
}
