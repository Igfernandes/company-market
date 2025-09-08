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
export async function deleteUserTrash({ id, ...payload } = {}) {
  const snackbar = new Snackbar();
  const snackbarTitleText = translate("Screens.users.snackbar_title");

  try {
    const { users } = API_ROUTES;

    const { data } = await ajax.get(
      getParams(users.permanently, {
        id: id ?? "",
      }),
      payload
    );

    return data;
  } catch (error) {
    snackbar.execute("NOTICE", {
      title: snackbarTitleText,
      message: translate("Screens.default.service_error"),
    });
  }
}
