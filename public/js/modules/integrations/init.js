import { inicializeForm } from "../../components/shared/forms/forms.js";
import { HandleStoreIntegrations } from "./index.js";
import { locations } from "./locations.js";

export const init = () => {
  const { form } = locations;

  if (!form) return;

  const boatCreate = new HandleStoreIntegrations();

  inicializeForm(form);
  form.addEventListener("submit", boatCreate.handleSubmit);
};
