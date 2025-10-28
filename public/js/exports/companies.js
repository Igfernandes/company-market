export const companiesExports = {
  "/dashboard/companies": ["/js/modules/private/companies/delete/init.js"],
  "/dashboard/companies/create": ["/js/modules/private/companies/form/init.js"],
  "/dashboard/companies/form/*": [
    "/js/modules/private/companies/form/init.js",
    "/js/modules/integrations/init.js",
  ],
  "/dashboard/companies/trash": [
    "/js/modules/private/companies/trash/Delete/init.js",
    "/js/modules/private/companies/trash/Recover/init.js",
  ],
};
