import { TableModules } from "../../../../../components/shared/layouts/table/exports.js";
import { getDeleteKey } from "../../../../../components/shared/layouts/table/utils/target.js";
import { ModalsModule } from "../../../../../components/shared/utils/modal/exports.js";
import { deleteCategory } from "../../../../../services/clients/categories/delete.js";
import { TABLE_CATEGORY_ID } from "../constants.js";

export function CategoryDeleteForm() {
  this.handleClick = async (ev) => {
    const btn = ev.target;
    const modalId = `delete`;
    ModalsModule.show(modalId);

    const cancelBtn = ModalsModule.getLeftButton(modalId);
    cancelBtn.addEventListener("click", () => ModalsModule.close(modalId));

    const confirmBtn = ModalsModule.getRightButton(modalId);

    confirmBtn.addEventListener(
      "click",
      async () => {
        const clientId = getDeleteKey(btn);

        const { success } = await deleteCategory({
          id: clientId,
        });

        if (success) {
          TableModules.load(TABLE_CATEGORY_ID);
          ModalsModule.close(modalId);
        }
      },
      { once: true }
    );
  };
}
