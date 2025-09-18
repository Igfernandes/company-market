import { Snackbar } from "../../../components/shared/utils/snackbar.js";
import { ajax } from "../../../libraries/Ajax/index.js";
import { API_ROUTES } from "../../../settings/api.js";
import { translate } from "../../../translate/index.js";

export async function postRole(payload = {}) {
  const snackbar = new Snackbar();
  const snackbarTitleText = translate("Screens.roles.snackbar_title");

  try {
    snackbar.execute("NOTICE", {
      title: snackbarTitleText,
      message: translate("Texts.awaiting_send"),
    });
    const { users } = API_ROUTES;

    const { data } = await ajax.post(users.roles.post, JSON.stringify(payload));

    if (!data || data.error)
      return snackbar.execute("FAIL", {
        title: snackbarTitleText,
        message: translate(data.error),
      });

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
  }
}
