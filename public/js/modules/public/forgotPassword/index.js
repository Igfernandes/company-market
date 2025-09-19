import {
  initRecaptcha,
  loadRecaptcha,
} from "../../../components/shared/utils/recaptcha.js";
import { snackbar } from "../../../components/shared/utils/snackbar.js";
import { Validations } from "../../../libraries/Validations/index.js";
import { postRecoverPassword } from "../../../services/recover/postPassword.js";
import { translate } from "../../../translate/index.js";
import { RecoverPasswordSchema } from "./rules.js";

export function RecoverPasswordForm() {
  this.handleSubmit = async (ev) => {
    ev.preventDefault();
    const form = ev.currentTarget;

    this.handleLoading(form, true);

    const payload = new FormData(form);
    const validations = new Validations(form);

    const formValid = await validations.execute(RecoverPasswordSchema);

    if (formValid.length > 0) {
      this.handleLoading(form, false);
      return;
    }

    snackbar.execute("NOTICE", {
      title: translate("Screens.forgot_password.sending_form"),
      message: translate("Screens.forgot_password.awaiting"),
    });

    initRecaptcha(
      (token) => {
        payload.append("recaptcha", token);
        this.send(form, payload);
      },
      () => this.handleLoading(form, false)
    );
  };

  this.send = async (form, payload) => {
    const { success } = (await postRecoverPassword(payload)) ?? {};

    setTimeout(() => {
      if (!success) {
        loadRecaptcha();
        return this.handleLoading(form, false);
      }
    }, 300);
  };

  this.handleLoading = (form, isDisabled) => {
    const button = form.querySelector("button[type='submit']");
    const input = form.querySelector("input[name='email']");

    button.disabled = isDisabled;
    input.readOnly = isDisabled;
  };
}
