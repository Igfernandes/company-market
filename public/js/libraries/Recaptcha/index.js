function handleRecaptcha(token) {
  const recaptchaInput = document.querySelector("[name='res-recaptcha']");

  if (recaptchaInput) recaptchaInput.value = token;
}
