export const API_ROUTES = {
  auth: "/api/auth",
  recover: {
    password: "/api/recovers/password",
  },
  notifications: {
    default: "/api/notifications",
  },
  contact: {
    post: "/api/contact",
  },
  subscribe: {
    post: "/api/subscribe",
  },
  users: {
    post: "/api/users",
    put: "/api/users/{id}",
    delete: "/api/users/{id}",
    permissions: "/api/users/{userId}/permissions",
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
  files: {
    post: "/api/files",
  },
  exports: {
    post: "/api/exports",
  },
  clients: {
    post: "/api/clients",
    put: "/api/clients/{id}",
    delete: "/api/clients/{id}",
    permanently: "/api/clients/trash/{id}",
    categories: {
      get: "/api/clients/categories/{id}",
      post: "/api/clients/categories",
      put: "/api/clients/categories/{id}",
      delete: "/api/clients/categories/{id}",
    },
  },
  companies: {
    post: "/api/companies",
    put: "/api/companies/{id}",
    delete: "/api/companies/{id}",
    permanently: "/api/companies/trash/{id}",
  },
};
