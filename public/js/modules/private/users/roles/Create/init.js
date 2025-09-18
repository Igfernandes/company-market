import { inicializeForm } from "../../../../../components/shared/forms/forms.js";
import { Validations } from "../../../../../libraries/Validations/index.js";
import { RoleSchema } from "../rules.js";
import { UserRolesCreate } from "./index.js";
import { locations } from "./locations.js";

export const init = () => {
  const { form } = locations;

  if (!form) return;

  const userRolesCreate = new UserRolesCreate();
  const validations = new Validations(form);

  inicializeForm(form);
  form.addEventListener("submit", userRolesCreate.handleSubmit);

  validations.instanceRules(RoleSchema, form);
};
