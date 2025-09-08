import { handleReloadTable } from "../../../../../components/shared/layouts/table/utils/handle.js";
import { getDeleteKey } from "../../../../../components/shared/layouts/table/utils/target.js";
import { handleCloseModal } from "../../../../../components/shared/utils/modal/handle.js";
import { showModal } from "../../../../../components/shared/utils/modal/target.js";
import { deleteUserTrash } from "../../../../../services/users/trash/delete.js";
import { TABLE_TRASH_ID } from "./init.js";

export function UserDeleteForm() {
  this.userId;

  this.handleClick = async (ev) => {
    const btn = ev.target;
    const modal = showModal("#modal_delete");

    modal.classList.remove("hidden");
    document.body.append(modal);

    const cancelBtn = modal.querySelector("[component='modal:left-btn']");
    cancelBtn.addEventListener("click", handleCloseModal);
    const confirmBtn = modal.querySelector("[component='modal:right-btn']");

    confirmBtn.addEventListener("click", async (ev) => {
      const userId = getDeleteKey(btn);

      const { success } = await deleteUserTrash({
        id: userId,
      });

      if (success) {
        handleReloadTable(TABLE_TRASH_ID);
        modal.remove();
      }
    });
  };
}
