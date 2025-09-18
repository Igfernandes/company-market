import {
  getTable,
} from "../../../../../components/shared/layouts/table/utils/target.js";
import { Observer } from "../../../../../helpers/observer.js";
import { TABLE_ROLE_ID } from "../constants.js";
import { UserDeleteForm } from "./index.js";

export const init = () => {
  const table = getTable(TABLE_ROLE_ID);

  const userDeleteForm = new UserDeleteForm();
  Observer(
    table.querySelector("tbody"),
    () => {
      const permissionOption = document.querySelectorAll(
        "[option-ref='permissions']"
      );

      if (permissionOption.length === 0) return;

      permissionOption.forEach((btn) => {
        btn.addEventListener("click", userDeleteForm.handleClick);
      });
    },
    { childList: true, attributes: false, characterData: false, subtree: false }
  );
};
