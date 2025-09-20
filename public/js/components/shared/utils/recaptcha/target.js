export function getToken() {
  const recaptchaInput = document.querySelector("[name='res-recaptcha']");

  if (!recaptchaInput) return;

  return recaptchaInput.value;
}
