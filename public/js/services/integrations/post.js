import { snackbar } from "../../components/shared/utils/snackbar.js";
import { ajax } from "../../libraries/Ajax/index.js";
import { API_ROUTES } from "../../settings/api.js";
import { translate } from "../../translate/index.js";

export async function postIntegrations(payload = {}) {
  const snackbarTitleText = translate("Screens.integrations.snackbar_title");

  try {
    const { integrations } = API_ROUTES;

    const { data } = await ajax.post(integrations.default, JSON.stringify(payload));

    if (!data || data.error)
      return snackbar.execute("fail", {
        title: snackbarTitleText,
        message: translate(data.error),
      }) ;

    snackbar.execute("success", {
      title: translate("Texts.send_solicitation"),
      message: translate(data.success),
    });
    return data;
  } catch (error) {
    snackbar.execute("NOTICE", {
      title: snackbarTitleText,
      message: translate("Screens.default.service_error"),
    });
  }
}
