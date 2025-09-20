import { ModalsModule } from "../../../../components/shared/utils/modal/exports.js";
import { UserInviteForm } from "./index.js";
import { locations, MODAL_INVITE_KEY } from "./locations.js";

export const init = () => {
  handleInviteModal();
  const btnSubmit = ModalsModule.getRightButton(MODAL_INVITE_KEY);

  if (!btnSubmit) return;
  const userInviteForm = new UserInviteForm();

  btnSubmit.addEventListener("click", userInviteForm.handleSubmit);
};

const handleInviteModal = () => {
  const { btnInvite } = locations;

  if (!btnInvite) return;

  btnInvite.addEventListener("click", () => {
    ModalsModule.show(MODAL_INVITE_KEY);
  });
};
