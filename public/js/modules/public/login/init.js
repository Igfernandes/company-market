import { Validations } from "../../../libraries/Validations/index.js";
import { LoginForm } from "./index.js";
import { locations } from "./locations.js";
import { loginSchema } from "./rules.js";

export const init = () => {
  const { form } = locations;

  if (!form) return;

  const loginForm = new LoginForm();
  const validations = new Validations();

  form.addEventListener("submit", loginForm.handleSubmit);

  validations.instanceRules(
    {
      ...loginSchema,
    },
    form
  );
};
