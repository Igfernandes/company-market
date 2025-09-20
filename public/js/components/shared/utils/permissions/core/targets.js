import { ModalsModule } from "../../modal/exports.js";
import { PERMISSION_MODAL_ID } from "./constants.js";

export function getPermissions() {
  const component = ModalsModule.getModal(PERMISSION_MODAL_ID);
  const checkboxes = Array.from(component.querySelectorAll("input:checked"));

  return checkboxes.map((checkbox) => +checkbox.value);
}

export function getPermissionsCheckbox() {
  const permissionElement = ModalsModule.getModal(PERMISSION_MODAL_ID);
  const inputs = permissionElement.querySelectorAll("input");
  return inputs;
}
