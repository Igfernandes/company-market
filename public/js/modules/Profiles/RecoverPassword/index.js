import { Snackbar } from "../../../components/snackbar/index.js";
import { patchRecoverPasswordConfirm } from "../../../services/Users/Recovers/patchPasswordConfirm.js";
import { patchRecoverPasswordRequest } from "../../../services/Users/Recovers/patchPasswordRequest.js";
import { locations } from "./locations.js";

export default function RecoverPassword() {
  this.handleSubmit = async (ev) => {
    ev.preventDefault();
    const { form, feedback } = locations;
    const fieldToken = form.querySelector("[name='token']");
    form.querySelector("button[type='submit']").disabled = true;

    if (!fieldToken || fieldToken.value == null) return;

    const { data: response } = await patchRecoverPasswordConfirm({
      token: fieldToken.value,
    });
  };

  this.handleRequestToken = async () => {
    const { form } = locations;
    const submitBtn = form.querySelector("button[type='submit']");
    const snackbar = new Snackbar();
    submitBtn.disabled = true;

    let SECONDS_REST = 60;
    setTimeout(function loadSubmitToken() {
      let response = document.querySelector(".response-msg");
      if (SECONDS_REST > 0 && response) {
        setTimeout(loadSubmitToken, 1000);
        response.classList.remove("d-none");

        response.querySelector("span").innerText = SECONDS_REST--;
      } else {
        submitBtn.disabled = false;
        if (response != null) {
          response.classList.add("d-none");
        }
      }
    }, 10);

    const { data: resp } = await patchRecoverPasswordRequest();

    if (resp.success)
      snackbar.show("success", "Novo token enviado com sucesso!");
  };
}
