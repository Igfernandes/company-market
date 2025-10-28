import { TableModules } from "../../../../../components/shared/layouts/table/exports.js";
import { Observer } from "../../../../../helpers/observer.js";
import { TABLE_TRASH_ID } from "../constants.js";
import { CompanyDeleteForm } from "./index.js";

export const init = () => {
  const table = TableModules.getTable(TABLE_TRASH_ID);
  const boatDeleteForm = new CompanyDeleteForm();

  const execute = () => {
    const deletesBtn = TableModules.getDeletesBtn(TABLE_TRASH_ID);

    if (deletesBtn.length === 0) return;

    deletesBtn.forEach((btn) => {
      btn.addEventListener("click", boatDeleteForm.handleClick);
    });
  };

  Observer(table.querySelector("tbody"), execute);
};
