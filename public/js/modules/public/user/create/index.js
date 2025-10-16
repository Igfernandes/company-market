import { GroupValidations } from "../../../../components/shared/forms/password/validations/criteria.js";
import { snackbar } from "../../../../components/shared/utils/snackbar.js";
import { redirect } from "../../../../helpers/route.js";
import { Navigation } from "../../../../libraries/Navigation/index.js";
import { Validations } from "../../../../libraries/Validations/index.js";
import { translate } from "../../../../translate/index.js";
import { UserCreateSchema } from "./rules.js";
import { postUsers } from "../../../../services/users/post.js";

export function UserCreateForm() {
  this.handleSubmit = async (ev) => {
    ev.preventDefault();
    const form = ev.currentTarget;
    this.handleLoading(form, true, "Enviando...");

    snackbar.execute("NOTICE", {
      title: translate("Screens.alter_password.sending_form"),
      message: translate("Screens.alter_password.awaiting"),
    });

    const payload = new FormData(form);
    const validations = new Validations(form);

    const formValid = await validations.execute(UserCreateSchema);
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
      this.handleLoading(form, false, "Criar Conta");
      groupValidations.execute(passwordValue);
      return;
    }

    const navigation = new Navigation();
    const birthdate = payload.get("birthdate");
    payload.append("token", navigation.getParam("invite_token"));
    payload.set("birthdate", birthdate.split("/").reverse().join("-"));

    const resp = await postUsers(payload);

    setTimeout(() => {
      if (resp && resp.success) redirect("/login");
      else this.handleLoading(form, false, "Criar Conta");
    }, [500]);
  };

  this.hasValidPassword = () => {};

  this.handleLoading = (form, isDisabled, text) => {
    const button = form.querySelector("button[type='submit']");

    button.disabled = isDisabled;
    button.innerText = text;
  };
}
