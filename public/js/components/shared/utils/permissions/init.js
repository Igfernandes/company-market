import { ModalsModule } from "../modal/exports.js";
import { PERMISSION_MODAL_ID } from "./core/constants.js";
import { Permissions } from "./index.js";

export const init = () => {
  const permissions = new Permissions();
  const btnSave = ModalsModule.getRightButton(PERMISSION_MODAL_ID);
  btnSave.addEventListener("click", permissions.handle);

  const btnCancel = ModalsModule.getLeftButton(PERMISSION_MODAL_ID);

  btnCancel.addEventListener("click", () =>
    ModalsModule.close(PERMISSION_MODAL_ID)
  );
};
