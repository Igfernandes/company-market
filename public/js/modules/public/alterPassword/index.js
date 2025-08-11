import { GroupValidations } from "../../../components/shared/forms/password/validations/criteria.js";
import { redirect } from "../../../helpers/route.js";
import { Navigation } from "../../../libraries/Navigation/index.js";
import { Validations } from "../../../libraries/Validations/index.js";
import { putRecoverPassword } from "../../../services/recover/putPassword.js";
import { AlterPasswordSchema } from "./rules.js";

export function AlterPasswordForm() {
  this.handleSubmit = async (ev) => {
    ev.preventDefault();
    const form = ev.currentTarget;

    this.handleLoading(form, true, "Enviando...");

    const payload = new FormData(form);
    const validations = new Validations(form);

    const formValid = await validations.execute(AlterPasswordSchema);
    const passwordGroupValidationElement = form.querySelector(
      "[component='group-validation']"
    );
    const groupValidations = new GroupValidations(
      passwordGroupValidationElement
    );
    const passwordValue = payload.get("password");

    if (
      formValid.length > 0 ||
      !groupValidations.hasAvailableCriterions(passwordValue)
    ) {
      this.handleLoading(form, false, "Alterar senha");
      groupValidations.execute(passwordValue);
      return;
    }

    const navigation = new Navigation();
    payload.append("recover_token", navigation.getParam("k"));

    const resp = await putRecoverPassword(payload);

    setTimeout(() => {
      if (resp.errors) {
        this.handleLoading(form, false, "Alterar senha");
      } else {
        this.handleLoading(form, true, "Enviado!");
        redirect("/");
      }
    }, [500]);
  };

  this.hasValidPassword = () => {};

  this.handleLoading = (form, isDisabled, text) => {
    const button = form.querySelector("button[type='submit']");

    button.disabled = isDisabled;
    button.innerText = text;
  };
}
