import {
  getTableDeletes,
  getTable,
} from "../../../../../components/shared/layouts/table/utils/target.js";
import { Observer } from "../../../../../helpers/observer.js";
import { UserDeleteForm } from "./index.js";

export const TABLE_TRASH_ID = "table_trash";
export const init = () => {
  const table = getTable(TABLE_TRASH_ID);

  const userDeleteForm = new UserDeleteForm();
  Observer(
    table.querySelector("tbody"),
    () => {
      const deletesBtn = getTableDeletes(TABLE_TRASH_ID);

      if (deletesBtn.length === 0) return;

      deletesBtn.forEach((btn) =>
        btn.addEventListener("click", userDeleteForm.handleClick)
      );
    },
    { childList: true, attributes: false, characterData: false, subtree: false }
  );
};
