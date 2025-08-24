import { Snackbar } from "../../components/shared/utils/snackbar.js";
import { ajax } from "../../libraries/Ajax/index.js";
import { API_ROUTES } from "../../settings/api.js";
import { translate } from "../../translate/index.js";

/**
 * Busca notificações.
 * @param {{id?: number, in_ids?: number[], author_id?: number}} [payload]
 * @returns {Promise<NotificationShape[]>}
 */
export async function getNotifications(payload = {}) {
  const snackbar = new Snackbar();
  const snackbarTitleText = translate("Screens.notifications.snackbar_title");

  try {
    const { notifications } = API_ROUTES;

    const { data } = await ajax.get(notifications.default, payload);

    if (!data || data.error)
      return snackbar.execute("FAIL", {
        title: snackbarTitleText,
        message: translate(data.error),
      });

    return data;
  } catch (error) {
    snackbar.execute("NOTICE", {
      title: snackbarTitleText,
      message: translate("Screens.default.service_error"),
    });
  }
}
