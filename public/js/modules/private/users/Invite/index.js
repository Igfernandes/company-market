import { Validations } from "../../../../libraries/Validations/index.js";
import { postInvite } from "../../../../services/users/postInvite.js";
import { locations } from "./locations.js";
import { InviteSchema } from "./rules.js";

export function UserInviteForm() {
  this.handleSubmit = async (ev) => {
    const button = ev.target;
    const { inviteForm: form, inviteModal: modal } = locations;

    this.handleLoading(button, true);

    const payload = new FormData(form);
    const validations = new Validations(form);

    const formValid = await validations.execute(InviteSchema);

    if (formValid.length > 0) {
      this.handleLoading(button, false);
      return;
    }

    const response = await postInvite(payload);

    if (response && response.success) {
      modal.classList.add("hidden");
      form.reset();
    }

    this.handleLoading(button, false);
  };

  this.handleLoading = (button, isLoading) => {
    if (!isLoading) {
      button.removeAttribute("disabled");
    } else button.setAttribute("disabled", isLoading);
  };
}
