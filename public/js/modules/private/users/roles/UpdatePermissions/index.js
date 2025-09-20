import { ModalsModule } from "../../../../../components/shared/utils/modal/exports.js";
import { PermissionsModule } from "../../../../../components/shared/utils/permissions/exports.js";
import { snackbar } from "../../../../../components/shared/utils/snackbar.js";
import { getRolePermissions } from "../../../../../services/users/roles/getPermissions.js";

export function UserDeleteForm() {
  this.userId;

  this.handleClick = async (ev) => {
    const btn = ev.target;
    const roleId = btn.getAttribute("option-key");
    const modalKey = `permissions`;

    if (!roleId)
      return snackbar.execute("NOTICE", {
        message: "Screens.roles.problems_in_table",
      });

    const permissions = await getRolePermissions({
      role_id: roleId,
    });

    PermissionsModule.hydrate(permissions);
    ModalsModule.show(modalKey);

    const handleClose = () => {
      ModalsModule.close(modalKey);
      PermissionsModule.clear();
    };

    const cancelBtn = ModalsModule.getLeftButton(modalKey);
    cancelBtn.addEventListener("click", handleClose);

    const closeIcon = ModalsModule.getCloseButton(modalKey);
    closeIcon.addEventListener("click", handleClose);

    const saveBtn = ModalsModule.getRightButton(modalKey);
    saveBtn.setAttribute(
      "permission-api",
      `/api/users/roles/${roleId}/permissions`
    );
    saveBtn.setAttribute("permission-key", roleId);
  };
}
