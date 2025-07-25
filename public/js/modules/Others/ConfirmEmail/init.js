import { ConfirmEmail, ConfirmEmailToken } from "./index.js";
import { locations } from "./locations.js";

export const init = () => {
  const { btnsSend, btnSubmit } = locations;
  const confirmEmail = new ConfirmEmail();
  const confirmEmailToken = new ConfirmEmailToken();

  btnsSend.forEach((btnSend) => {
    btnSend.addEventListener("click", confirmEmail.handle);
  });

  btnSubmit.addEventListener("click", confirmEmailToken.handle);
};
