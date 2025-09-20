export function init(callback, errorCallback) {
  const recaptcha = document.querySelector("[component='recaptcha']");

  window.onRecaptchaVerified = callback;

  if (errorCallback) window.onRecaptchaExpired = errorCallback;

  if (recaptcha) hcaptcha.execute();
}
export function load() {
  const recaptcha = document.querySelector("[component='recaptcha']");

  if (recaptcha) hcaptcha.reset();
}
