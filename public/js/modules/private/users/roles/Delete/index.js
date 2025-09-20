import { TableModules } from "../../../../../components/shared/layouts/table/exports.js";
import { getDeleteKey } from "../../../../../components/shared/layouts/table/utils/target.js";
import { ModalsModule } from "../../../../../components/shared/utils/modal/exports.js";
import { deleteRole } from "../../../../../services/users/roles/delete.js";
import { TABLE_ROLE_ID } from "../constants.js";

export function UserDeleteForm() {
  this.userId;

  this.handleClick = async (ev) => {
    const btn = ev.target;
    const modalId = `delete`;
    ModalsModule.show(modalId);

    const cancelBtn = ModalsModule.getLeftButton(modalId);
    cancelBtn.addEventListener("click", () => ModalsModule.close(modalId));

    const confirmBtn = ModalsModule.getRightButton(modalId);

    confirmBtn.addEventListener(
      "click",
      async (ev) => {
        const userId = getDeleteKey(btn);

        const { success } = await deleteRole({
          id: userId,
        });

        if (success) {
          TableModules.load(TABLE_ROLE_ID);
          ModalsModule.close(modalId);
        }
      },
      { once: true }
    );
  };
}
