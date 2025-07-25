import { handleRecaptchaTokenUpdate } from "../../../../helpers/recaptcha.js";
import { Validations } from "../../../../libraries/Validations/index.js";
import { postRecoverPassword } from "../../../../services/recover/postPassword.js";
import { RecoverPasswordSchema } from "./rules.js";

export function RecoverPasswordForm() {
  this.handleSubmit = async (ev) => {
    ev.preventDefault();
    const form = ev.currentTarget;

    this.handleLoading(form, true, "Enviando...");

    const payload = new FormData(form);
    const validations = new Validations();

    const formValid = await validations.execute(RecoverPasswordSchema, form);

    if (formValid.length > 0) {
      this.handleLoading(form, false, "Enviar código");
      return;
    }

    const resp = await postRecoverPassword(payload);
    handleRecaptchaTokenUpdate();

    setTimeout(() => {
      if (resp.errors) {
        this.handleLoading(form, false, "Enviar código");
      } else {
        this.handleLoading(form, true, "Enviado!");
      }
    }, [500]);
  };

  this.handleLoading = (form, isDisabled, text) => {
    const button = form.querySelector("button[type='submit']");
    const input = form.querySelector("input[name='email']");

    button.disabled = isDisabled;
    input.readOnly = isDisabled;
    button.innerText = text;
  };
}
