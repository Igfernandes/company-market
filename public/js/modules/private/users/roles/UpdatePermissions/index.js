import { ModalsModule } from "../../../../../components/shared/utils/modal/exports.js";
import { PermissionsModule } from "../../../../../components/shared/utils/permissions/exports.js";
import { snackbar } from "../../../../../components/shared/utils/snackbar.js";
import { getRolePermissions } from "../../../../../services/users/roles/getPermissions.js";

export function UserDeleteForm() {
  this.userId;

  this.handleClick = async (ev) => {
    const btn = ev.target;
    const roleId = btn.getAttribute("option-key");
    const modalId = `#modal_permissions`;

    if (!roleId)
      return snackbar.execute("NOTICE", {
        message: "Screens.roles.problems_in_table",
      });

    const permissions = await getRolePermissions({
      role_id: roleId,
    });

    PermissionsModule.hydrate(permissions);
    ModalsModule.show(modalId);

    const handleClose = () => {
      ModalsModule.close(modalId);
      PermissionsModule.clear();
    };

    const cancelBtn = ModalsModule.getLeftButton(modalId);
    cancelBtn.addEventListener("click", handleClose);

    const closeIcon = ModalsModule.getCloseButton(modalId);
    closeIcon.addEventListener("click", handleClose);

    const saveBtn = ModalsModule.getRightButton(modalId);
    saveBtn.setAttribute(
      "permission-api",
      `/api/users/roles/${roleId}/permissions`
    );
    saveBtn.setAttribute("permission-key", roleId);
  };
}
