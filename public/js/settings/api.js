export const API_ROUTES = {
  auth: "/api/auth",
  recover: {
    password: "/api/recovers/password",
  },
  notifications: {
    default: "/api/notifications",
  },
  users: {
    put: "/api/users",
    delete: "/api/users/{id}",
    permanently: "/api/users/trash/{id}",
    roles: {
      get: "/api/users/roles/{id}",
      post: "/api/users/roles",
      put: "/api/users/roles/{id}",
      delete: "/api/users/roles/{id}",
      getPermissions: "/api/users/roles/{id}/permissions",
    },
  },
  invites: {
    user: "/api/invites/user",
  },
  exports: {
    post: "/api/exports",
  },
};
