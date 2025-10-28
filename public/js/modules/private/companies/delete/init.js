import { TableModules } from "../../../../components/shared/layouts/table/exports.js";
import { getTable } from "../../../../components/shared/layouts/table/utils/target.js";
import { Observer } from "../../../../helpers/observer.js";
import { CompanyDeleteForm } from "./index.js";

export const init = () => {
  const table = getTable();
  const userDeleteForm = new CompanyDeleteForm();

  const execute = () => {
    const deletesBtn = TableModules.getDeletesBtn("companies");

    if (deletesBtn.length === 0) return;

    deletesBtn.forEach((btn) =>
      btn.addEventListener("click", userDeleteForm.handleClick)
    );
  };

  Observer(table.querySelector("tbody"), execute);
};
