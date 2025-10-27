import { snackbar } from "../components/shared/utils/snackbar.js";
import { translate } from "../translate/index.js";

export function hydrateForm(formSelector, payload = {}) {
  const form = document.querySelector(formSelector);

  if (!form)
    return console.warn(`O formulário ${formSelector} não pode ser encontrado`);

  Object.entries(payload).forEach(([key, value]) => {
    const field = form.elements[key];
    if (!field) return;

    field.placeholder = value;
    field.value = value;
    field.dispatchEvent(new Event("keyup", { bubbles: true }));
  });

  return form;
}

export function handleLoading(
  form = document.querySelector(""),
  isLoading = false,
  text = "Salvar"
) {
  const button = form.querySelector("button[type='submit']");

  if (isLoading) {
    button.disabled = true;
    button.innerText = "Enviando...";
    
    snackbar.execute("NOTICE", {
      title: translate("Screens.alter_password.sending_form"),
      message: translate("Screens.alter_password.awaiting"),
    });
  } else button.removeAttribute("disabled");

  button.innerText = text;
}
