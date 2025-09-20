import { TableModules } from "../../../../../components/shared/layouts/table/exports.js";
import { PermissionsModule } from "../../../../../components/shared/utils/permissions/exports.js";
import { Validations } from "../../../../../libraries/Validations/index.js";
import { postRole } from "../../../../../services/users/roles/post.js";
import { TABLE_ROLE_ID } from "../constants.js";
import { RoleSchema } from "../rules.js";

export function UserRolesCreate() {
  this.handleSubmit = async (ev) => {
    ev.preventDefault();
    const form = ev.currentTarget;
    this.handleLoading(form, true);

    const payload = new FormData(form);
    const validations = new Validations(form);

    const formValid = await validations.execute(RoleSchema);
    const permissionIds = PermissionsModule.getPermissions();

    if (formValid.length === 0) {
      const { success } = await postRole({
        name: payload.get("name"),
        description: payload.get("description"),
        permissions: permissionIds,
      });

      if (success) {
        TableModules.load(TABLE_ROLE_ID);
        form.reset();
        PermissionsModule.clear();
      }
    }

    this.handleLoading(form, false);
  };

  this.handleLoading = (form, isDisabled) => {
    const button = form.querySelector("button[type='submit']");

    if (isDisabled) button.disabled = true;
    else button.removeAttribute("disabled");

    button.innerText = "Atualizar";
  };
}
