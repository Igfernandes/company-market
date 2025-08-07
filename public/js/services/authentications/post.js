import { Snackbar } from "../../components/shared/utils/snackbar.js";
import { ajax, Ajax } from "../../libraries/Ajax/index.js";
import { API_ROUTES } from "../../settings/api.js";
import { translate } from "../../translate/index.js";

export async function postAuth(payload = {}) {
  const snackbar = new Snackbar();
  const snackbarTitleText = translate("Screens.auth.snackbar_title");

  try {
    const { auth } = API_ROUTES;

    const { data } = await ajax.post(auth, JSON.stringify(payload));

    if (data.errors)
      return snackbar.execute("FAIL", {
        title: snackbarTitleText,
        message: translate(data.errors),
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
