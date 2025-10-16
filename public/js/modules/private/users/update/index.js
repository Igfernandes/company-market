import { snackbar } from "../../../../components/shared/utils/snackbar.js";
import { getFormDataToJson } from "../../../../helpers/route.js";
import { Validations } from "../../../../libraries/Validations/index.js";
import { putUser } from "../../../../services/users/put.js";
import { translate } from "../../../../translate/index.js";
import { UserUpdateSchema } from "./rules.js";

export function UserUpdateForm() {
  this.handleSubmit = async (ev) => {
    ev.preventDefault();
    const form = ev.currentTarget;
    this.handleLoading(form, true);

    snackbar.execute("NOTICE", {
      title: translate("Screens.default.sending_form"),
      message: translate("Screens.default.awaiting"),
    });

    const payload = new FormData(form);
    const validations = new Validations(form);

    const formValid = await validations.execute(UserUpdateSchema);

    if (formValid.length === 0) await putUser(getFormDataToJson(payload));

    this.handleLoading(form, false);
  };

  this.handleLoading = (form, isDisabled) => {
    const button = form.querySelector("button[type='submit']");

    if (isDisabled) button.disabled = true;
    else button.removeAttribute("disabled");

    button.innerText = "Atualizar";
  };
}
