import { ModalsModule } from "../../../../components/shared/utils/modal/exports.js";
import { Validations } from "../../../../libraries/Validations/index.js";
import { postInvite } from "../../../../services/users/postInvite.js";
import { locations, MODAL_INVITE_KEY } from "./locations.js";
import { InviteSchema } from "./rules.js";

export function UserInviteForm() {
  this.handleSubmit = async (ev) => {
    const { inviteForm: form } = locations;
    this.handleLoading(true);

    const payload = new FormData(form);
    const validations = new Validations(form);

    const formValid = await validations.execute(InviteSchema);

    if (formValid.length > 0) {
      this.handleLoading(false);
      return;
    }

    const response = await postInvite(payload);

    if (response && response.success) {
      ModalsModule.close(MODAL_INVITE_KEY);
      this.handleLoading(false);
      form.reset();
    }
  };

  this.handleLoading = (isLoading = false) => {
    ModalsModule.isLoading(MODAL_INVITE_KEY, {
      btnSide: "right",
      loading: isLoading,
    });
  };
}
