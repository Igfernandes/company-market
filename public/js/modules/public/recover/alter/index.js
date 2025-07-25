import { Navigation } from "../../../../helpers/navigation/index.js";
import { handleRecaptchaTokenUpdate } from "../../../../helpers/recaptcha.js";
import { redirect } from "../../../../helpers/route.js";
import { Validations } from "../../../../libraries/Validations/index.js";
import { putRecoverPassword } from "../../../../services/recover/putPassword.js";
import { AlterPasswordSchema } from "./rules.js";

export function AlterPasswordForm() {
  this.handleSubmit = async (ev) => {
    ev.preventDefault();
    const form = ev.currentTarget;

    this.handleLoading(form, true, "Enviando...");

    const payload = new FormData(form);
    const validations = new Validations();

    const formValid = await validations.execute(AlterPasswordSchema, form);

    if (formValid.length > 0) {
      this.handleLoading(form, false, "Alterar senha");
      return;
    }

    const navigation = new Navigation();
    payload.append("recover_token", navigation.getParam("k"));

    const resp = await putRecoverPassword(payload);
    handleRecaptchaTokenUpdate();

    setTimeout(() => {
      if (resp.errors) {
        this.handleLoading(form, false, "Alterar senha");
      } else {
        this.handleLoading(form, true, "Enviado!");
        redirect("/");
      }
    }, [500]);
  };

  this.handleLoading = (form, isDisabled, text) => {
    const button = form.querySelector("button[type='submit']");

    button.disabled = isDisabled;
    button.innerText = text;
  };
}
