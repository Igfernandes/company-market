import { TableModules } from "../../../../../components/shared/layouts/table/exports.js";
import { ModalsModule } from "../../../../../components/shared/utils/modal/exports.js";
import { deleteTrash } from "../../../../../services/companies/trash/delete.js";
import { TABLE_TRASH_ID } from "../constants.js";

export function CompanyDeleteForm() {
  const modalKey = "delete";

  this.handleClick = async (ev) => {
    const btn = ev.target;
    ModalsModule.show(modalKey);

    const cancelBtn = ModalsModule.getLeftButton(modalKey);
    cancelBtn.addEventListener("click", () => ModalsModule.close(modalKey));

    const confirmBtn = ModalsModule.getRightButton(modalKey);

    confirmBtn.addEventListener(
      "click",
      async () => {
        const boatId = TableModules.getDeleteKey(btn);

        const data = await deleteTrash({
          id: boatId,
        });

        if (data && data.success) {
          TableModules.load(TABLE_TRASH_ID);
          ModalsModule.close(modalKey);
        }
      },
    );
  };
}
