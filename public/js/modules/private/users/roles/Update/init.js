import { TableModules } from "../../../../../components/shared/layouts/table/exports.js";
import { Observer } from "../../../../../helpers/observer.js";
import { TABLE_ROLE_ID } from "../constants.js";
import { UserRolesUpdate } from "./index.js";

export const init = () => {
  const table = TableModules.getTable(TABLE_ROLE_ID);

  const execute = () => {
    const permissionOption = document.querySelectorAll("[option-ref='update']");

    if (permissionOption.length === 0) return;

    permissionOption.forEach((option) => {
      option.addEventListener("click", () =>
        userRolesUpdate.handleClick(option)
      );
    });
  };

  const userRolesUpdate = new UserRolesUpdate();
  Observer(table.querySelector("tbody"), execute);
};
