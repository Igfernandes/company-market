import { handleReloadTable } from "../../../../../components/shared/layouts/table/utils/handle.js";
import {
  ModalsModule,
} from "../../../../../components/shared/utils/modal/exports.js";
import { PermissionsModule } from "../../../../../components/shared/utils/permissions/exports.js";
import { hydrateForm } from "../../../../../helpers/form.js";
import { Validations } from "../../../../../libraries/Validations/index.js";
import { getRoles } from "../../../../../services/users/roles/get.js";
import { putRole } from "../../../../../services/users/roles/put.js";
import { TABLE_ROLE_ID } from "../constants.js";
import { RoleSchema } from "../rules.js";

export function UserRolesUpdate() {
  const modalId = "#modal_update";
  this.handleClick = async (option) => {
    const roles = await getRoles();

    const rightBtn = ModalsModule.getRightButton(modalId);
    const roleId = option.getAttribute("option-key");

    const currentRole = roles.find((role) => role.id == roleId);

    const form = hydrateForm("[send='role-update']", currentRole);
    ModalsModule.show(modalId);

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

      handleReloadTable(TABLE_ROLE_ID);
      form.reset();
      PermissionsModule.clear();
      ModalsModule.close(modalId);
    }
  };
}
