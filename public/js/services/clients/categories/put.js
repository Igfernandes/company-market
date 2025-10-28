import { snackbar } from "../../../components/shared/utils/snackbar.js";
import { getParams } from "../../../helpers/route.js";
import { ajax } from "../../../libraries/Ajax/index.js";
import { API_ROUTES } from "../../../settings/api.js";
import { translate } from "../../../translate/index.js";

export async function putCategory({ id, ...payload } = {}) {
  const snackbarTitleText = translate("Screens.categories.snackbar_title");

  try {
    snackbar.execute("NOTICE", {
      title: snackbarTitleText,
      message: translate("Texts.awaiting_send"),
    });
    const { clients } = API_ROUTES;

    const { data } = await ajax.custom(
      getParams(clients.categories.put, {
        id: id,
      }),
      payload,
      {
        method: "PUT",
      }
    );

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
