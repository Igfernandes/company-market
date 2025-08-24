import { snackbar } from "../../components/shared/utils/snackbar.js";
import { openPage } from "../../helpers/window.js";
import { ajax } from "../../libraries/Ajax/index.js";
import { API_ROUTES } from "../../settings/api.js";
import { translate } from "../../translate/index.js";

export async function postExport(payload = {}) {
  const snackbarTitleText = translate("Screens.exports.snackbar_title");

  try {
    snackbar.execute("NOTICE", {
      title: snackbarTitleText,
      message: translate("Texts.awaiting_file_created"),
    });
    const { exports } = API_ROUTES;

    const { data } = await ajax.post(exports.post, JSON.stringify(payload));

    if (!data || data.error)
      return snackbar.execute("fail", {
        title: snackbarTitleText,
        message: translate(data.error, "Screens.default.service_error"),
      });

    openPage(data.file);

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
