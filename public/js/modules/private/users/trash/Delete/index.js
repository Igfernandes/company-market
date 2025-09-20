import { TableModules } from "../../../../../components/shared/layouts/table/exports.js";
import { ModalsModule } from "../../../../../components/shared/utils/modal/exports.js";
import { TABLE_TRASH_ID } from "../../roles/constants.js";

export function UserDeleteForm() {
  this.userId;
  const modalKey = "delete";

  this.handleClick = async (ev) => {
    const btn = ev.target;
    ModalsModule.show(modalKey);

    const cancelBtn = ModalsModule.getLeftButton(modalKey);
    cancelBtn.addEventListener("click", () =>  ModalsModule.close(modalKey));

    const confirmBtn = ModalsModule.getRightButton(modalKey);

    confirmBtn.addEventListener(
      "click",
      async () => {
        const userId = TableModules.getDeleteKey(btn);

        const { success } = await deleteRole({
          id: userId,
        });

        if (success) {
          TableModules.load(TABLE_TRASH_ID);
          ModalsModule.close(modalKey);
        }
      },
      { once: true }
    );
  };
}
