import { PERMISSION_MODAL_ID } from "./core/constants.js";
import { getPermissions, getPermissionsCheckbox } from "./core/targets.js";
import { clear, hydrate } from "./core/utils.js";

export const PermissionsModule = {
  hydrate,
  clear,
  getPermissions,
  getPermissionsCheckbox,
  modalId: PERMISSION_MODAL_ID,
};
