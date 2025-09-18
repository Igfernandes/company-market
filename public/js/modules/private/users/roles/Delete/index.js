import { handleReloadTable } from "../../../../../components/shared/layouts/table/utils/handle.js";
import { getDeleteKey } from "../../../../../components/shared/layouts/table/utils/target.js";
import { ModalsModule } from "../../../../../components/shared/utils/modal/exports.js";
import { deleteRole } from "../../../../../services/users/roles/delete.js";
import { TABLE_ID } from "./init.js";

export function UserDeleteForm() {
  this.userId;

  this.handleClick = async (ev) => {
    const btn = ev.target;
    const modalId = `#modal_delete`;
    ModalsModule.show(modalId);

    const cancelBtn = ModalsModule.getLeftButton(modalId);
    cancelBtn.addEventListener("click", ModalsModule.close(modalId));

    const confirmBtn = ModalsModule.getRightButton(modalId);
    confirmBtn.replaceWith(confirmBtn.cloneNode(true));
    const newConfirmBtn = ModalsModule.getRightButton(modalId);

    newConfirmBtn.addEventListener(
      "click",
      async (ev) => {
        const userId = getDeleteKey(btn);

        const { success } = await deleteRole({
          id: userId,
        });

        if (success) {
          handleReloadTable(TABLE_ID);
          ModalsModule.close(`#modal_delete`);
        }
      },
      { once: true }
    );
  };
}
