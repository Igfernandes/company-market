import { TableModules } from "../../../../../components/shared/layouts/table/exports.js";
import { Observer } from "../../../../../helpers/observer.js";
import { TABLE_ROLE_ID } from "../constants.js";
import { UserDeleteForm } from "./index.js";

export const init = () => {
  const table = TableModules.getTable(TABLE_ROLE_ID);

  const execute = () => {
    const permissionOption = document.querySelectorAll(
      "[option-ref='permissions']"
    );

    if (permissionOption.length === 0) return;

    permissionOption.forEach((btn) => {
      btn.addEventListener("click", userDeleteForm.handleClick);
    });
  };

  const userDeleteForm = new UserDeleteForm();
  Observer(table.querySelector("tbody"), execute);
};
