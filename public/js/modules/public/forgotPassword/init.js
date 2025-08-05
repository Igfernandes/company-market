import { Validations } from "../../../libraries/Validations/index.js";
import { RecoverPasswordForm } from "./index.js";
import { locations } from "./locations.js";
import { RecoverPasswordSchema } from "./rules.js";
import { inicializeForm } from "../../../components/shared/forms/forms.js";

export const init = () => {
  const { form } = locations;

  if (!form) return;

  const recoverPasswordForm = new RecoverPasswordForm();
  const validations = new Validations(form);

  inicializeForm(form);
  form.addEventListener("submit", recoverPasswordForm.handleSubmit);

  validations.instanceRules(RecoverPasswordSchema);
};
