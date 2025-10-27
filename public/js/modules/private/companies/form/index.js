import { handleLoading } from "../../../../helpers/form.js";
import { getFormDataToJson, redirect } from "../../../../helpers/route.js";
import { Validations } from "../../../../libraries/Validations/index.js";
import { postCompany } from "../../../../services/companies/post.js";
import { putCompany } from "../../../../services/companies/put.js";
import { WEB_ROUTES } from "../../../../settings/web.js";
import { ClientSchema } from "../rules.js";

export function CompanyCreate() {
  this.handleSubmit = async (ev) => {
    ev.preventDefault();
    const form = ev.currentTarget;
    handleLoading(form, true);

    const payload = new FormData(form);
    const validations = new Validations(form);

    const formValid = await validations.execute(ClientSchema);

    if (formValid.length !== 0) return handleLoading(form, false);

    const companyId = payload.get("id");
    let data = {};

    const payloadJson = getFormDataToJson(payload)
    if (companyId) {
      data = await putCompany(payloadJson);
    } else {
      data = await postCompany(payloadJson);
    }

    handleLoading(form, false);

    if (!data || !data["success"]) return;

    if (!companyId) {
      redirect(WEB_ROUTES.dashboard.companies);
    }
  };
}
