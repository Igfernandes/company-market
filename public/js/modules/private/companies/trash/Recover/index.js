import { TableModules } from "../../../../../components/shared/layouts/table/exports.js";
import { ModalsModule } from "../../../../../components/shared/utils/modal/exports.js";
import { snackbar } from "../../../../../components/shared/utils/snackbar.js";
import { postCompanyTrash } from "../../../../../services/companies/trash/post.js";
import { translate } from "../../../../../translate/index.js";
import { TABLE_TRASH_ID } from "../constants.js";

export function CompanyRecoverForm() {
  const modalKey = "recover";

  this.handleClick = async (ev) => {
    const tableRows = TableModules.checkedRows(TABLE_TRASH_ID);
    const companyIds = tableRows.map((row) => row[0]);

    if (companyIds.length == 0)
      return snackbar.execute("NOTICE", {
        title: "Recuperação Invalida",
        message: translate("Screens.companies.trash.invalid.client_ids"),
      });

    ModalsModule.show(modalKey);

    const cancelBtn = ModalsModule.getLeftButton(modalKey);
    cancelBtn.addEventListener("click", () => ModalsModule.close(modalKey));
    const confirmBtn = ModalsModule.getRightButton(modalKey);

    confirmBtn.addEventListener(
      "click",
      async () => {
        const { success } = await postCompanyTrash({
          in_ids: companyIds,
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
