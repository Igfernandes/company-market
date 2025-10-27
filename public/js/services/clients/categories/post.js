import { snackbar } from "../../../components/shared/utils/snackbar.js";
import { ajax } from "../../../libraries/Ajax/index.js";
import { API_ROUTES } from "../../../settings/api.js";
import { translate } from "../../../translate/index.js";

export async function postCategory(payload = {}) {
  const snackbarTitleText = translate("Screens.categories.snackbar_title");

  try {
    snackbar.execute("NOTICE", {
      title: snackbarTitleText,
      message: translate("Texts.awaiting_send"),
    });

    const { clients } = API_ROUTES;

    const { data } = await ajax.post(clients.categories.post, payload);

    if (!data || data.error) {
      snackbar.execute("FAIL", {
        title: snackbarTitleText,
        message: translate(data.error),
      });
      return {};
    }

    snackbar.execute("SUCCESS", {
      title: snackbarTitleText,
      message: translate(data.success),
    });
    return data;
  } catch (error) {
    snackbar.execute("NOTICE", {
      title: snackbarTitleText,
      message: translate("Screens.default.service_error"),
    });

    return {};
  }
}
