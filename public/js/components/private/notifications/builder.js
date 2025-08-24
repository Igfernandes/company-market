import { translate } from "../../../translate/index.js";

/**
 * Processa dados de notificação.
 *
 * @param {NotificationShape} data - Objeto com os dados da notificação.
 * @param {string} component - Nome do componente relacionado.
 *
 * @return {Element}
 */
export function notificationBuilder(data = {}, notification) {
  notification.querySelector("[component='notification:author']").innerHTML =
    data.author.name;
  notification.querySelector("[component='notification:title']").innerHTML =
    data.title ?? translate(`Notifications.${data.operation}.title`);
  notification.querySelector(
    "[component='notification:message-content']"
  ).innerHTML =
    data.message ?? translate(`Notifications.${data.operation}.text`);
  notification.querySelector("[component='notification:datetime']").innerHTML =
    dayjs(data.created_at).format("DD/MM/YYYY HH:mm:ss");

  return notification;
}
