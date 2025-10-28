import { snackbar } from "../../components/shared/utils/snackbar.js";
import { getParams } from "../../helpers/route.js";
import { ajax } from "../../libraries/Ajax/index.js";
import { API_ROUTES } from "../../settings/api.js";
import { translate } from "../../translate/index.js";

export async function putClient({ id, ...payload } = {}) {
  const snackbarTitleText = translate("Screens.clients.snackbar_title");

  try {
    const { clients } = API_ROUTES;
    const { data } = await ajax.custom(
      getParams(clients.put, { id }),
      payload,
      {
        method: "PUT",
      }
    );

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
    console.log(error)
    snackbar.execute("NOTICE", {
      title: snackbarTitleText,
      message: translate("Screens.default.service_error"),
    });
    return {};
  }
}
