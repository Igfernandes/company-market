import { UserUpdateForm } from "./index.js";
import { locations } from "./locations.js";
import { inicializeForm } from "../../../../components/shared/forms/forms.js";

export const init = () => {
  const { form } = locations;

  if (!form) return;

  const userUpdateForm = new UserUpdateForm();

  inicializeForm(form);
  form.addEventListener("submit", userUpdateForm.handleSubmit);
};
