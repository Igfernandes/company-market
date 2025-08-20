import { Component } from "../../../helpers/components.js";
import { getNotifications } from "../../../services/notifications/get.js";
import { notificationBuilder } from "./builder.js";

export const init = async () => {
  const container = document.querySelector("[component='notification']");

  if (!container) return;

  const content = container.querySelector("[component='notification:content']");
  const messageComponent = await Component("/utils/notification/message", {
    author: "none",
    message: "none",
    datetime: "2025-01-01 00:00",
  });

  const data = await getNotifications();

  if (data.length > 0) content.innerHTML = "";

  data.map((notificationData) =>
    content.appendChild(notificationBuilder(notificationData, messageComponent))
  );
};
