import { snackbar } from "../../components/shared/utils/snackbar.js";
import { formDataToJson } from "../../helpers/payload.js";
import { ajax } from "../../libraries/Ajax/index.js";
import { API_ROUTES } from "../../settings/api.js";
import { translate } from "../../translate/index.js";

export async function putRecoverPassword(payload = {}) {
  const snackbarTitleText = translate("Screens.alter_password.snackbar_title");

  try {
    const { recover } = API_ROUTES;

    const { data } = await ajax.custom(
      recover.password,
      formDataToJson(payload),
      {
        method: "put",
        headers: {
          "Content-Type": "application/json",
        },
      }
    );

    if (!data || data.error)
      return snackbar.execute("FAILED", {
        title: snackbarTitleText,
        message: translate(data.error),
      });

    snackbar.execute("SUCCESS", {
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
