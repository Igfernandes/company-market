import { TableModules } from "../../../../components/shared/layouts/table/exports.js";
import { getTable } from "../../../../components/shared/layouts/table/utils/target.js";
import { Observer } from "../../../../helpers/observer.js";
import { UserDeleteForm } from "./index.js";

export const init = () => {
  const table = getTable();
  const userDeleteForm = new UserDeleteForm();

  const execute = () => {
    const deletesBtn = TableModules.getDeletesBtn("users");

    if (deletesBtn.length === 0) return;

    deletesBtn.forEach((btn) =>
      btn.addEventListener("click", userDeleteForm.handleClick)
    );
  };

  Observer(table.querySelector("tbody"), execute);
};
