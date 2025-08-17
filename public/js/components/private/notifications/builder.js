import { translate } from "../../../translate/index.js";

/**
 * Processa dados de notificação.
 *
 * @param {NotificationShape} data - Objeto com os dados da notificação.
 * @param {string} component - Nome do componente relacionado.
 *
 * @return {Element}
 */
export function notificationBuilder(data = {}, component) {
  const componentContainer = document.createElement("div");
  componentContainer.innerHTML = component;

  componentContainer.querySelector(
    "[component='notification:author']"
  ).innerHTML = data.author.name;
  componentContainer.querySelector(
    "[component='notification:title']"
  ).innerHTML =
    data.title ?? translate(`Notifications.${data.operation}.title`);
  componentContainer.querySelector(
    "[component='notification:message-content']"
  ).innerHTML =
    data.message ?? translate(`Notifications.${data.operation}.text`);
  componentContainer.querySelector(
    "[component='notification:datetime']"
  ).innerHTML = dayjs(data.created_at).format("DD/MM/YYYY HH:mm:ss");

  return componentContainer.children[0];
}
