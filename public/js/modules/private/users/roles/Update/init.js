import { getTable } from "../../../../../components/shared/layouts/table/utils/target.js";
import { Observer } from "../../../../../helpers/observer.js";
import { TABLE_ROLE_ID } from "../constants.js";
import { UserRolesUpdate } from "./index.js";

export const TABLE_TRASH_ID = "table_trash";
export const init = () => {
  const table = getTable(TABLE_ROLE_ID);

  const userRolesUpdate = new UserRolesUpdate();
  Observer(
    table.querySelector("tbody"),
    () => {
      const permissionOption = document.querySelectorAll(
        "[option-ref='update']"
      );

      if (permissionOption.length === 0) return;

      permissionOption.forEach((option) => {
        option.addEventListener("click", () =>
          userRolesUpdate.handleClick(option)
        );
      });
    },
    { childList: true, attributes: false, characterData: false, subtree: false }
  );
};
