import { Validations } from "../../../libraries/Validations/index.js";
import { AlterPasswordForm } from "./index.js";
import { locations } from "./locations.js";
import { AlterPasswordSchema } from "./rules.js";
import { inicializeForm } from "../../../components/shared/forms/forms.js";

export const init = () => {
  const { form } = locations;

  if (!form) return;

  const alterPasswordForm = new AlterPasswordForm();
  const validations = new Validations(form);

  inicializeForm(form);
  form.addEventListener("submit", alterPasswordForm.handleSubmit);

  validations.instanceRules(AlterPasswordSchema, form);
};
