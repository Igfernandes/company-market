import { UserRecoverForm } from "./index.js";
import { locations } from "./locations.js";

export const init = () => {
  const { btnRecovers } = locations;
  const userRecoverForm = new UserRecoverForm();

  btnRecovers.forEach((btnRecover) =>
    btnRecover.addEventListener("click", userRecoverForm.handleClick)
  );
};
