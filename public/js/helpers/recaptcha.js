export function getRecaptchaToken() {
  const recaptchaInput = document.querySelector("[name='res-recaptcha']");

  if (!recaptchaInput) return;

  return recaptchaInput.value;
}

export function initRecaptcha() {
  const recaptcha = document.querySelector("[data-component='recaptcha']");

  if (recaptcha) hcaptcha.execute();
}
export function loadRecaptcha() {
  const recaptcha = document.querySelector("[data-component='recaptcha']");

  if (recaptcha) hcaptcha.reset();
}
