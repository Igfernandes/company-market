import { inicializeForm } from "../../../../components/shared/forms/forms.js";
import { Validations } from "../../../../libraries/Validations/index.js";
import { ClientSchema } from "../rules.js";
import { ClientCreate } from "./index.js";
import { locations } from "./locations.js";

export const init = () => {
  const { form } = locations;

  if (!form) return;

  const boatCreate = new ClientCreate();
  const validations = new Validations(form);

  inicializeForm(form);
  form.addEventListener("submit", boatCreate.handleSubmit);

  validations.instanceRules(ClientSchema, form);
};
