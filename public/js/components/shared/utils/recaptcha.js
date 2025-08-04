export function getRecaptchaToken() {
  const recaptchaInput = document.querySelector("[name='res-recaptcha']");

  if (!recaptchaInput) return;

  return recaptchaInput.value;
}

export function initRecaptcha(callback) {
  const recaptcha = document.querySelector("[component='recaptcha']");

  window.onRecaptchaVerified = callback;

  if (recaptcha) hcaptcha.execute();
}
export function loadRecaptcha() {
  const recaptcha = document.querySelector("[component='recaptcha']");

  if (recaptcha) hcaptcha.reset();
}
