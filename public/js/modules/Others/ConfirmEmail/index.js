import { Snackbar } from "../../../components/snackbar/index.js";
import { VALID_EMAIL_REGEX } from "../../../constants/regex.js";
import { getConfirmEmail } from "../../../services/Tokens/getConfirmEmail.js";
import { postConfirmEmail } from "../../../services/Tokens/postConfirmEmail.js";
import { locations } from "./locations.js";

export function ConfirmEmail() {
  this.handle = async (ev) => {
    const snackbar = new Snackbar();
    const btnEmail = ev.currentTarget;
    const formGroup = btnEmail.closest(".form-group");
    const field = formGroup.querySelector("[data-confirm-email='field']");

    if ((field && !field.value) || !VALID_EMAIL_REGEX.test(field.value))
      return snackbar.show(
        "failed",
        "Será necessário preencher primeiro com um e-mail válido antes de efetuar essa solicitação.",
        {
          title: "Confirmação de E-mail Inválida",
        }
      );

    const content = btnEmail.innerHTML;
    btnEmail.innerHTML = "Aguarde  &#8987;";
    const { data: resp } = await postConfirmEmail({
      email: field.value,
    });

    if (resp && resp.success) $("#emailConfirmModal").modal("show");

    btnEmail.innerHTML = content;
  };
}

export function ConfirmEmailToken() {
  this.handle = async (ev) => {
    ev.preventDefault();
    const { form, fieldTokenReference } = locations;
    const snackbar = new Snackbar();
    const field = form.querySelector("[name='token']");

    if (!field)
      return snackbar.show(
        "failed",
        "Ocorreu um problema ao computar essa ação. Recarregue a página e tente novamente."
      );

    const { data: resp } = await getConfirmEmail({
      token: field.value,
    });

    if (resp.isAvaliable === true) {
      field.setCustomValidity("");
      field.classList.remove("is-invalid");
      $("#emailConfirmModal").modal("hide");

      fieldTokenReference.value = field.value;
    } else {
      field.setCustomValidity("O token inserido é inválido");
      field.classList.add("is-invalid");
      const group = field.closest("div");
      const tooltipBox = group.querySelector(`.invalid-tooltip`);

      tooltipBox.textContent = "O token inserido é inválido";
    }
  };
}
