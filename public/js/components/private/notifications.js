import { Component } from "../../helpers/components.js";

export const init = async () => {
  const container = document.querySelector("[component='notification']");
  const content = container.querySelector("[component='notification:content']");
  const messageComponent = await Component("/utils/notification/message", {
    author: "none",
    message: "seila",
    datetime: "2025-01-01 00:00",
  });

  console.log(messageComponent);
};
