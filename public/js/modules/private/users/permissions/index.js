import { snackbar } from "../../../../components/shared/utils/snackbar.js";
import { getFormDataToJson } from "../../../../helpers/route.js";
import { postUsersPermissions } from "../../../../services/users/postPermissions.js";
import { translate } from "../../../../translate/index.js";

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

    await postUsersPermissions(getFormDataToJson(payload));

    this.handleLoading(form, false);
  };

  this.handleLoading = (form, isDisabled) => {
    const button = form.querySelector("button[type='submit']");

    if (isDisabled) button.disabled = true;
    else button.removeAttribute("disabled");

    button.innerText = "Atualizar";
  };
}
