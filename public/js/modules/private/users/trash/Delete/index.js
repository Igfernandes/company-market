import { handleReloadTable } from "../../../../../components/shared/layouts/table/utils/handle.js";
import { getDeleteKey } from "../../../../../components/shared/layouts/table/utils/target.js";
import { ModalsModule } from "../../../../../components/shared/utils/modal/exports.js";
import { TABLE_TRASH_ID } from "./init.js";

export function UserDeleteForm() {
  this.userId;
  const modalId = "#modal_delete";

  this.handleClick = async (ev) => {
    const btn = ev.target;
    ModalsModule.show("#modal_delete");

    const cancelBtn = ModalsModule.getLeftButton(modalId);
    cancelBtn.addEventListener("click", ModalsModule.close(modalId));

    const confirmBtn = ModalsModule.getRightButton(modalId);
    confirmBtn.replaceWith(confirmBtn.cloneNode(true));
    const newConfirmBtn = ModalsModule.getRightButton(modalId);

    newConfirmBtn.addEventListener(
      "click",
      async () => {
        const userId = getDeleteKey(btn);

        const { success } = await deleteRole({
          id: userId,
        });

        if (success) {
          handleReloadTable(TABLE_TRASH_ID);
          ModalsModule.close(modalId);
        }
      },
      { once: true }
    );
  };
}
