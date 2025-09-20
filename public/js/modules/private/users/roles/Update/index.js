import { TableModules } from "../../../../../components/shared/layouts/table/exports.js";
import { ModalsModule } from "../../../../../components/shared/utils/modal/exports.js";
import { PermissionsModule } from "../../../../../components/shared/utils/permissions/exports.js";
import { hydrateForm } from "../../../../../helpers/form.js";
import { Validations } from "../../../../../libraries/Validations/index.js";
import { getRoles } from "../../../../../services/users/roles/get.js";
import { putRole } from "../../../../../services/users/roles/put.js";
import { TABLE_ROLE_ID } from "../constants.js";
import { RoleSchema } from "../rules.js";

export function UserRolesUpdate() {
  const modalKey = "update";

  this.handleClick = async (option) => {
    const roles = await getRoles();

    const leftBtn = ModalsModule.getLeftButton(modalKey);
    leftBtn.addEventListener("click", () => ModalsModule.close(modalKey));

    const rightBtn = ModalsModule.getRightButton(modalKey);
    const roleId = option.getAttribute("option-key");

    const currentRole = roles.find((role) => role.id == roleId);

    const form = hydrateForm("[send='role-update']", currentRole);
    ModalsModule.show(modalKey);

    rightBtn.addEventListener(
      "click",
      async () => {
        rightBtn.disabled = true;
        await this.handleSubmit(form, roleId);
        rightBtn.disabled = false;
      },
      { once: true }
    );
  };

  this.handleSubmit = async (form, roleId) => {
    const payload = new FormData(form);
    const validations = new Validations(form);

    const formValid = await validations.execute(RoleSchema);

    if (formValid.length === 0) {
      const { success } = await putRole({
        id: roleId,
        name: payload.get("name"),
        description: payload.get("description"),
      });

      if (!success) return;

      TableModules.load(TABLE_ROLE_ID);
      form.reset();
      PermissionsModule.clear();
      ModalsModule.close(modalKey);
    }
  };
}
