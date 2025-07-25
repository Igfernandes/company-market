import { Validations } from "../../../../libraries/Validations/index.js";
import { AlterPasswordForm } from "./index.js";
import { locations } from "./locations.js";
import { AlterPasswordSchema } from "./rules.js";

export const init = () => {
  const { form } = locations;

  if (!form) return;

  const alterPasswordForm = new AlterPasswordForm();
  const validations = new Validations();

  form.addEventListener("submit", alterPasswordForm.handleSubmit);

  validations.instanceRules(AlterPasswordSchema, form);
};
