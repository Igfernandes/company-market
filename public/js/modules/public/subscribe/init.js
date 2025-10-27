import { Validations } from "../../../libraries/Validations/index.js";
import { SubscribeForm } from "./index.js";
import { locations } from "./locations.js";
import { SubscribeSchema } from "./rules.js";
import { inicializeForm } from "../../../components/shared/forms/forms.js";

export const init = () => {
  const { form } = locations;

  if (!form) return;

  const subscribeForm = new SubscribeForm();
  const validations = new Validations(form);

  inicializeForm(form);
  form.addEventListener("submit", subscribeForm.handleSubmit);

  validations.instanceRules(SubscribeSchema);
};
