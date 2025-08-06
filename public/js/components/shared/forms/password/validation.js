
export const init = () => {
  const passwordGroup = document.querySelector("[component='password-group']");
  const newPassword = passwordGroup.querySelector("[component='password:new-password']");
  const passwordConfirmation = passwordGroup.querySelector("[component='password:confirmation']");

  handleEquality = () => {
    const newPasswordInput = newPassword.querySelector("input");
    const confirmationInput = passwordConfirmation.querySelector("input");

    if (newPasswordInput.value !== confirmationInput.value) {
      passwordConfirmation.querySelector("[data-invalid='confirmation']").textContent = "Passwords do not match.";
    }
    else {
      passwordConfirmation.querySelector("[data-invalid='confirmation']").textContent = "";
    }
  };
};
