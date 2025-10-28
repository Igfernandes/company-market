import { handleLoading } from "../../helpers/form.js";
import { formDataToJson } from "../../helpers/payload/index.js";
import { postIntegrations } from "../../services/integrations/post.js";

export function HandleStoreIntegrations() {
  this.handleSubmit = async (ev) => {
    ev.preventDefault();
    const form = ev.currentTarget;
    handleLoading(form, true);

    const payload = new FormData(form);
    const payloadJson = formDataToJson(payload);

    const data = await postIntegrations(payloadJson);
    handleLoading(form, false);

    if (!data || !data["success"]) return;
  };
}
