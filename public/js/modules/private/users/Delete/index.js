import { deleteUser } from "../../../../services/users/delete.js";
import { ModalsModule } from "../../../../components/shared/utils/modal/exports.js";
import { TableModules } from "../../../../components/shared/layouts/table/exports.js";

export function UserDeleteForm() {
  const ModalKey = "user_delete";
  this.handleClick = async (ev) => {
    const btn = ev.target;
    const userId = TableModules.getDeleteKey(btn);

    ModalsModule.show(ModalKey);

    const cancelBtn = ModalsModule.getLeftButton(ModalKey);
    cancelBtn.addEventListener("click", () => ModalsModule.close(ModalKey));
    const confirmBtn = ModalsModule.getRightButton(ModalKey);

    confirmBtn.addEventListener("click", async () => {
      const { success } = await deleteUser({
        id: userId,
      });

      if (success) {
        TableModules.load("users");
        ModalsModule.close(ModalKey);
      }
    });
  };
}
