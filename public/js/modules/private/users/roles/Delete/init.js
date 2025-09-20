import { TableModules } from "../../../../../components/shared/layouts/table/exports.js";
import { Observer } from "../../../../../helpers/observer.js";
import { TABLE_ROLE_ID } from "../constants.js";
import { UserDeleteForm } from "./index.js";

export const init = () => {
  const table = TableModules.getTable(TABLE_ROLE_ID);

  const execute = () => {
    const deletesBtn = TableModules.getDeletesBtn(TABLE_ROLE_ID);

    if (deletesBtn.length === 0) return;

    deletesBtn.forEach((btn) => {
      btn.addEventListener("click", userDeleteForm.handleClick);
    });
  };

  const userDeleteForm = new UserDeleteForm();
  Observer(table.querySelector("tbody"), execute);
};
