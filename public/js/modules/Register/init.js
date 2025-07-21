import { Validations } from "../../libs/Validations/index.js";
import { RegisterForm } from "./index.js";
import { locations } from "./locations.js";
import { rules } from "./rules/index.js";
import { athleteFieldsRules } from "./rules/athleteFields.js";
import { clubFieldsRules } from "./rules/clubFields.js";
import { federationFieldsRules } from "./rules/federationFields.js";

export const init = () => {
  const registerForm = new RegisterForm();
  const { btnSubmit, form } = locations;
  const validations = new Validations();

  if (!form) return;

  btnSubmit.addEventListener("click", registerForm.handle);
  form.addEventListener("submit", registerForm.handle);
  validations.instanceRules(
    {
      ...rules,
      ...athleteFieldsRules,
      ...clubFieldsRules,
      ...federationFieldsRules,
    },
    form
  );
};
