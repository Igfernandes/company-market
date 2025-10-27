import { ModalsModule } from "../../../../components/shared/utils/modal/exports.js";
import { TableModules } from "../../../../components/shared/layouts/table/exports.js";
import { deleteClient } from "../../../../services/clients/delete.js";

export function ClientDeleteForm() {
  const ModalKey = "client_delete";
  this.handleClick = async (ev) => {
    const btn = ev.target;
    const clientId = TableModules.getDeleteKey(btn);

    ModalsModule.show(ModalKey);

    const cancelBtn = ModalsModule.getLeftButton(ModalKey);
    cancelBtn.addEventListener("click", () => ModalsModule.close(ModalKey));
    const confirmBtn = ModalsModule.getRightButton(ModalKey);

    confirmBtn.addEventListener("click", async () => {
      const { success } = await deleteClient({
        id: clientId,
      });

      if (success) {
        TableModules.load("clients");
        ModalsModule.close(ModalKey);
      }
    });
  };
}
