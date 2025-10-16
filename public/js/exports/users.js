export const usersExports = {
  "/dashboard/users": [
    "/js/modules/private/users/Delete/init.js",
    "/js/modules/private/users/Invite/init.js",
  ],
  "/dashboard/users/trash": [
    "/js/modules/private/users/trash/Delete/init.js",
    "/js/modules/private/users/trash/Recover/init.js",
  ],
  "/dashboard/users/role": [
    "/js/modules/private/users/roles/Create/init.js",
    "/js/modules/private/users/roles/Delete/init.js",
    "/js/modules/private/users/roles/UpdatePermissions/init.js",
    "/js/modules/private/users/roles/Update/init.js",
  ],
  "/dashboard/users/invites": ["/js/modules/private/users/Invite/init.js"],
  "/dashboard/users/profile/*": [
    "/js/modules/private/users/update/init.js",
    "/js/modules/private/users/permissions/init.js",
  ],
};
