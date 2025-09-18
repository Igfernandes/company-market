import { ModalsModule } from "../../modal/exports.js";
import { PERMISSION_MODAL_ID } from "./constants.js";
import { getPermissionsCheckbox } from "./targets.js";

export function clear() {
  const inputs = getPermissionsCheckbox();
  const rightBtn = ModalsModule.getRightButton(PERMISSION_MODAL_ID);

  rightBtn.removeAttribute("permission-api");
  rightBtn.removeAttribute("permission-key");
  inputs.forEach((input) => (input.checked = false));
}

export function hydrate(permissions = []) {
  const inputs = getPermissionsCheckbox();
  const permissionIds = permissions.map((permission) => permission.id);

  inputs.forEach((checkbox) => {
    checkbox.checked = permissionIds.includes(+checkbox.value);
  });
}
