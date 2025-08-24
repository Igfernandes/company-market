import { Snackbar } from "../../components/shared/utils/snackbar.js";
import { ajax } from "../../libraries/Ajax/index.js";
import { API_ROUTES } from "../../settings/api.js";
import { translate } from "../../translate/index.js";

export async function postInvite(payload = {}) {
  const snackbar = new Snackbar();
  const snackbarTitleText = translate("Screens.invites.snackbar_title");

  try {
    snackbar.execute("NOTICE", {
      title: snackbarTitleText,
      message: translate("Texts.awaiting_send"),
    });
    const { invites } = API_ROUTES;

    const { data } = await ajax.post(invites.user, payload);

    if (!data || data.error)
      return snackbar.execute("fail", {
        title: snackbarTitleText,
        message: translate(data.error),
      });

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
