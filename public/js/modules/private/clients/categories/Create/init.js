import { inicializeForm } from "../../../../../components/shared/forms/forms.js";
import { Validations } from "../../../../../libraries/Validations/index.js";
import { CategorySchema } from "../rules.js";
import { UserCategoryCreate } from "./index.js";
import { locations } from "./locations.js";

export const init = () => {
  const { form } = locations;

  if (!form) return;

  const userRolesCreate = new UserCategoryCreate();
  const validations = new Validations(form);

  inicializeForm(form);
  form.addEventListener("submit", userRolesCreate.handleSubmit);

  validations.instanceRules(CategorySchema, form);
};
