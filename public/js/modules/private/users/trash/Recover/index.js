import {
  getCheckedRows,
  handleReloadTable,
} from "../../../../../components/shared/layouts/table/utils/handle.js";
import { handleCloseModal } from "../../../../../components/shared/utils/modal/handle.js";
import { showModal } from "../../../../../components/shared/utils/modal/target.js";
import { snackbar } from "../../../../../components/shared/utils/snackbar.js";
import { postUserTrash } from "../../../../../services/users/trash/post.js";
import { translate } from "../../../../../translate/index.js";
import { TABLE_TRASH_ID } from "./init.js";

export function UserRecoverForm() {
  this.userId;

  this.handleClick = async (ev) => {
    const btn = ev.target;

    const tableRows = getCheckedRows(TABLE_TRASH_ID);
    const usersIds = tableRows.map((row) => row[0]);

    if (usersIds.length == 0)
      return snackbar.execute("NOTICE", {
        title: "Recuperação Invalida",
        message: translate("Screens.users.trash.invalid.user_ids"),
      });

    const modal = showModal("#modal_recover");
    modal.classList.remove("hidden");
    document.body.append(modal);

    const cancelBtn = modal.querySelector("[component='modal:left-btn']");
    cancelBtn.addEventListener("click", handleCloseModal);
    const confirmBtn = modal.querySelector("[component='modal:right-btn']");

    confirmBtn.addEventListener("click", async (ev) => {
      const { success } = await postUserTrash({
        in_ids: usersIds,
      });

      if (success) {
        handleReloadTable(TABLE_TRASH_ID);
        modal.remove();
      }
    });
  };
}
