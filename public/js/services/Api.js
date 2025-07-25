export const baseUrl = window.location.origin + "/api";

export const ApiRoutes = {
  authentication: {
    social: `${baseUrl}/authentications/social`,
  },
  tokens: {
    confirmEmail: `${baseUrl}/tokens/confirm-email`,
  },
  users: {
    default: `${baseUrl}/users/`,
    data: {
      post: (column) => {
        return `${baseUrl}/users/${column}/data/`;
      },
    },
    usersTokens: `${baseUrl}/users/tokens`,
    photo: `${baseUrl}/users/photo`,
  },
  companies: {
    data: {
      post: (column) => {
        return `${baseUrl}/companies/${column}/data/`;
      },
    },
  },
  customForms: {
    post: `${baseUrl}/custom-forms`,
    get: (customFormsId) => `${baseUrl}/custom-forms/${customFormsId ?? ""}`,
  },
};
