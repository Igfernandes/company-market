import {
  getCheckedRows,
  handleReloadTable,
} from "../../../../../components/shared/layouts/table/utils/handle.js";
import { ModalsModule } from "../../../../../components/shared/utils/modal/exports.js";
import { snackbar } from "../../../../../components/shared/utils/snackbar.js";
import { postUserTrash } from "../../../../../services/users/trash/post.js";
import { translate } from "../../../../../translate/index.js";
import { TABLE_TRASH_ID } from "./init.js";

export function UserRecoverForm() {
  this.userId;
  const modalId = "#modal_recover";

  this.handleClick = async (ev) => {
    const tableRows = getCheckedRows(TABLE_TRASH_ID);
    const usersIds = tableRows.map((row) => row[0]);

    if (usersIds.length == 0)
      return snackbar.execute("NOTICE", {
        title: "Recuperação Invalida",
        message: translate("Screens.users.trash.invalid.user_ids"),
      });

    ModalsModule.show(modalId);

    const cancelBtn = ModalsModule.getLeftButton(modalId);
    cancelBtn.addEventListener("click", ModalsModule.close(modalId));
    const confirmBtn = ModalsModule.getRightButton(modalId);

    confirmBtn.addEventListener("click", async () => {
      const { success } = await postUserTrash({
        in_ids: usersIds,
      });

      if (success) {
        handleReloadTable(TABLE_TRASH_ID);
        ModalsModule.remove();
      }
    });
  };
}
