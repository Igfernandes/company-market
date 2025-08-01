import { initRecaptcha } from "./recaptcha.js";

export function inicializeForm(form) {
  initRecaptcha();
  form.querySelector("[type='submit']").removeAttribute("disabled");
}
