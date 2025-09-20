import { TableModules } from "../../../../../components/shared/layouts/table/exports.js";
import { ModalsModule } from "../../../../../components/shared/utils/modal/exports.js";
import { snackbar } from "../../../../../components/shared/utils/snackbar.js";
import { postUserTrash } from "../../../../../services/users/trash/post.js";
import { translate } from "../../../../../translate/index.js";
import { TABLE_TRASH_ID } from "../../roles/constants.js";

export function UserRecoverForm() {
  this.userId;
  const modalKey = "recover";

  this.handleClick = async (ev) => {
    const tableRows = TableModules.checkedRows(TABLE_TRASH_ID);
    const usersIds = tableRows.map((row) => row[0]);

    if (usersIds.length == 0)
      return snackbar.execute("NOTICE", {
        title: "Recuperação Invalida",
        message: translate("Screens.users.trash.invalid.user_ids"),
      });

    ModalsModule.show(modalKey);

    const cancelBtn = ModalsModule.getLeftButton(modalKey);
    cancelBtn.addEventListener("click", () => ModalsModule.close(modalKey));
    const confirmBtn = ModalsModule.getRightButton(modalKey);

    confirmBtn.addEventListener("click", async () => {
      const { success } = await postUserTrash({
        in_ids: usersIds,
      });

      if (success) {
        TableModules.load(TABLE_TRASH_ID);
        ModalsModule.close(modalKey);
      }
    });
  };
}
