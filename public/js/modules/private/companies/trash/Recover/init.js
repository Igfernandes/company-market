import { CompanyRecoverForm } from "./index.js";
import { locations } from "./locations.js";

export const init = () => {
  const { btnRecovers } = locations;
  const recoverForm = new CompanyRecoverForm();

  btnRecovers.forEach((btnRecover) =>
    btnRecover.addEventListener("click", recoverForm.handleClick)
  );
};
