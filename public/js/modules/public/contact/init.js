import { Validations } from "../../../libraries/Validations/index.js";
import { ContactForm } from "./index.js";
import { locations } from "./locations.js";
import { ContactSchema } from "./rules.js";
import { inicializeForm } from "../../../components/shared/forms/forms.js";

export const init = () => {
  const { form } = locations;

  if (!form) return;

  const contactForm = new ContactForm();
  const validations = new Validations(form);

  inicializeForm(form);
  form.addEventListener("submit", contactForm.handleSubmit);

  validations.instanceRules(ContactSchema);
};
