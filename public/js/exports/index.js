import { clientsExports } from "./clients.js";
import { companiesExports } from "./companies.js";
import { exportsExternal } from "./external.js";
import { profileExports } from "./profile.js";
import { usersExports } from "./users.js";

export const exports = {
  ...exportsExternal,
  ...profileExports,
  ...companiesExports,
  ...usersExports,
  ...clientsExports,
};
