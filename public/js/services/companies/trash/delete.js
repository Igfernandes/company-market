import { Snackbar } from "../../../components/shared/utils/snackbar.js";
import { getParams } from "../../../helpers/route.js";
import { ajax } from "../../../libraries/Ajax/index.js";
import { API_ROUTES } from "../../../settings/api.js";
import { translate } from "../../../translate/index.js";

/**
 *
 * @param {{
 *  id: string
 * }} payload
 *
 * @returns void;
 */
export async function deleteTrash(payload = {}) {
  const snackbar = new Snackbar();
  const snackbarTitleText = translate("Screens.companies.snackbar_title");

  try {
    const { companies } = API_ROUTES;

    const { data } = await ajax.custom(
      getParams(companies.permanently, payload),
      {},
      {
        method: "DELETE",
      }
    );

    if (data.error)
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
    return 
  }
}
