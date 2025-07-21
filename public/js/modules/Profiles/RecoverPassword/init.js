import RecoverPassword from "./index.js";
import { locations } from "./locations.js";

export const init = () => {
  const recoverPassword = new RecoverPassword();
  const { feedback, token, btnSubmit } = locations;

  token.addEventListener("click", recoverPassword.handleRequestToken);
  btnSubmit.addEventListener("click", recoverPassword.handleSubmit);
};
