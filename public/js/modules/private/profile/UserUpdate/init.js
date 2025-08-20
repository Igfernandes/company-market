import { Validations } from "../../../../libraries/Validations/index.js";
import { UserUpdateForm } from "./index.js";
import { locations } from "./locations.js";
import { UserUpdateSchema } from "./rules.js";
import { inicializeForm } from "../../../../components/shared/forms/forms.js";

export const init = () => {
  const { form } = locations;

  if (!form) return;

  const userUpdateForm = new UserUpdateForm();
  const validations = new Validations(form);

  inicializeForm(form);
  form.addEventListener("submit", userUpdateForm.handleSubmit);

  validations.instanceRules(UserUpdateSchema, form);
};
