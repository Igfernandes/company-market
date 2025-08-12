import { Snackbar } from "../../components/shared/utils/snackbar.js";
import { ajax } from "../../libraries/Ajax/index.js";
import { API_ROUTES } from "../../settings/api.js";
import { translate } from "../../translate/index.js";

export async function postRecoverPassword(payload = {}) {
  const snackbar = new Snackbar();
  const snackbarTitleText = translate("Screens.forgot_password.snackbar_title");

  try {
    const { recover } = API_ROUTES;

    const { data } = await ajax.post(recover.password, payload, {});

    if (!data || data.error)
      return snackbar.execute("failed", {
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
