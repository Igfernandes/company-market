export function handleRecaptchaTokenUpdate() {
  grecaptcha
    .execute("6LfCAOwqAAAAANyYzK2-3r84RXjwQ5w3P6qS0WEp", { action: "submit" })
    .then(function (token) {
      document.getElementById("g-recaptcha-response").value = token;
    });
}
