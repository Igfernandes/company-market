import { snackbar } from "../../../components/shared/utils/snackbar.js";
import { Validations } from "../../../libraries/Validations/index.js";
import { postSubscribe } from "../../../services/subscribe/postSubscribe.js";
import { SubscribeSchema } from "./rules.js";

export function SubscribeForm() {
  this.handleSubmit = async (ev) => {
    ev.preventDefault();
    const form = ev.currentTarget;

    this.handleLoading(form, true);

    const payload = new FormData(form);
    const validations = new Validations(form);

    const formValid = await validations.execute(SubscribeSchema);

    if (formValid.length > 0) {
      this.handleLoading(form, false);
      return;
    }
    snackbar.execute("NOTICE", {
      title: "Inscrição de Notificação",
      message: translate("Texts.awaiting_send"),
    });

    await postSubscribe(payload);
  };

  this.handleLoading = (form, isDisabled) => {
    const button = form.querySelector("button[type='submit']");

    button.disabled = isDisabled;
  };
}
