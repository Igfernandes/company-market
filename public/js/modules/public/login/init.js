import { inicializeForm } from "../../../helpers/forms.js";
import { LoginForm } from "./index.js";
import { locations } from "./locations.js";

export const init = () => {
  const { form } = locations;

  if (!form) return;

  const loginForm = new LoginForm();

  form.addEventListener("submit", loginForm.handleSubmit);
  inicializeForm(form);
};
