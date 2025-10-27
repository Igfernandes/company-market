import { snackbar } from "../../../components/shared/utils/snackbar.js";
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
export async function getCategories({ id } = {}) {
  const snackbarTitleText = translate("Screens.categories.snackbar_title");

  try {
    const { clients } = API_ROUTES;

    const { data } = await ajax.get(
      getParams(clients.categories.get, {
        id: id ?? "",
      })
    );

    return data;
  } catch (error) {
    snackbar.execute("NOTICE", {
      title: snackbarTitleText,
      message: translate("Screens.default.service_error"),
    });
  }
}
