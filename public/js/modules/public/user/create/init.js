import { Validations } from "../../../../libraries/Validations/index.js";
import { UserCreateForm } from "./index.js";
import { locations } from "./locations.js";
import { UserCreateSchema } from "./rules.js";
import { inicializeForm } from "../../../../components/shared/forms/forms.js";

export const init = () => {
  const { form } = locations;

  if (!form) return;

  const userCreateForm = new UserCreateForm();
  const validations = new Validations(form);

  inicializeForm(form);
  form.addEventListener("submit", userCreateForm.handleSubmit);

  validations.instanceRules(UserCreateSchema, form);
};
