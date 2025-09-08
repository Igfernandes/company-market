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
  },
  invites: {
    user: "/api/invites/user",
  },
  exports: {
    post: "/api/exports",
  },
};
