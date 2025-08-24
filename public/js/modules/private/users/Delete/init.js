import {
  getTableDeletes,
  getTable,
} from "../../../../components/shared/layouts/table/utils/target.js";
import { Observer } from "../../../../helpers/observer.js";
import { UserDeleteForm } from "./index.js";

export const init = () => {
  const table = getTable();
  Observer(
    table.querySelector("tbody"),
    () => {
      const deletesBtn = getTableDeletes("users");

      if (deletesBtn.length === 0) return;

      const userDeleteForm = new UserDeleteForm();

      deletesBtn.forEach((btn) =>
        btn.addEventListener("click", userDeleteForm.handleClick)
      );
    },
    { childList: true, attributes: false, characterData: false, subtree: false }
  );
};
