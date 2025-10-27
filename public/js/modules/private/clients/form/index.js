import { handleLoading } from "../../../../helpers/form.js";
import { getFormDataToJson, redirect } from "../../../../helpers/route.js";
import { Validations } from "../../../../libraries/Validations/index.js";
import { postClient } from "../../../../services/clients/post.js";
import { putClient } from "../../../../services/clients/put.js";
import { WEB_ROUTES } from "../../../../settings/web.js";
import { ClientSchema } from "../rules.js";

export function ClientCreate() {
  this.handleSubmit = async (ev) => {
    ev.preventDefault();
    const form = ev.currentTarget;
    handleLoading(form, true);

    const payload = new FormData(form);
    const validations = new Validations(form);

    const formValid = await validations.execute(ClientSchema);

    if (formValid.length !== 0) return handleLoading(form, false);

    const clientId = payload.get("id");
    let data = {};

    if (clientId) {
      data = await putClient(getFormDataToJson(payload));
    } else {
      data = await postClient(payload);
    }

    handleLoading(form, false);

    if (!data || !data["success"]) return;

    if (!clientId) {
      redirect(WEB_ROUTES.dashboard.clients);
    }
  };
}
