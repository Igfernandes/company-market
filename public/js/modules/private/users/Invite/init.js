import { showModal } from "../../../../components/shared/utils/modal/target.js";
import { UserInviteForm } from "./index.js";
import { locations } from "./locations.js";

export const init = () => {
  const { inviteModal } = locations;
  handleInviteModal();
  const btnSubmit = inviteModal.querySelector("[component='modal:right-btn']");

  if (!btnSubmit) return;
  const userInviteForm = new UserInviteForm();

  btnSubmit.addEventListener("click", userInviteForm.handleSubmit);
};

const handleInviteModal = () => {
  const { btnInvite, inviteModal } = locations;

  if (!btnInvite) return;

  btnInvite.addEventListener("click", () => {
    showModal(inviteModal);
  });
};
