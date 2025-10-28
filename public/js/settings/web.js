const baseurl = window.location.origin;

export const WEB_ROUTES = {
  login: baseurl + "/acesso",
  dashboard: {
    overview: "/dashboard/overview",
    clients: "/dashboard/clients",
    companies: "/dashboard/companies",
  },
};
