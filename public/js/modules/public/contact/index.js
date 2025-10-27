import { snackbar } from "../../../components/shared/utils/snackbar.js";
import { Validations } from "../../../libraries/Validations/index.js";
import { postContact } from "../../../services/contact/postContact.js";
import { ContactSchema } from "./rules.js";

export function ContactForm() {
  this.handleSubmit = async (ev) => {
    ev.preventDefault();
    const form = ev.currentTarget;

    this.handleLoading(form, true);

    const payload = new FormData(form);
    const validations = new Validations(form);

    const formValid = await validations.execute(ContactSchema);

    if (formValid.length > 0) {
      this.handleLoading(form, false);
      return;
    }
    
    snackbar.execute("NOTICE", {
      title: "Solicitação de Contato",
      message: translate("Texts.awaiting_send"),
    });
    await postContact(payload);
  };

  this.handleLoading = (form, isDisabled) => {
    const button = form.querySelector("button[type='submit']");

    button.disabled = isDisabled;
  };
}
