import { TableModules } from "../../../../../components/shared/layouts/table/exports.js";
import { ModalsModule } from "../../../../../components/shared/utils/modal/exports.js";
import { snackbar } from "../../../../../components/shared/utils/snackbar.js";
import { postClientTrash } from "../../../../../services/clients/trash/post.js";
import { translate } from "../../../../../translate/index.js";
import { TABLE_TRASH_ID } from "../constants.js";

export function ClientRecoverForm() {
  const modalKey = "recover";

  this.handleClick = async (ev) => {
    const tableRows = TableModules.checkedRows(TABLE_TRASH_ID);
    const boatIds = tableRows.map((row) => row[0]);

    if (boatIds.length == 0)
      return snackbar.execute("NOTICE", {
        title: "Recuperação Invalida",
        message: translate("Screens.clients.trash.invalid.client_ids"),
      });

    ModalsModule.show(modalKey);

    const cancelBtn = ModalsModule.getLeftButton(modalKey);
    cancelBtn.addEventListener("click", () => ModalsModule.close(modalKey));
    const confirmBtn = ModalsModule.getRightButton(modalKey);

    confirmBtn.addEventListener(
      "click",
      async () => {
        const { success } = await postClientTrash({
          in_ids: boatIds,
        });

        if (success) {
          TableModules.load(TABLE_TRASH_ID);
          TableModules.setToggleChecked(TABLE_TRASH_ID, false);
          ModalsModule.close(modalKey);
        }
      },
      {
        once: true,
      }
    );
  };
}
