import { loadTopic } from "./utils.js";

export function handleTargetTopics(ev) {
  const menuItem = ev.currentTarget;
  const refMenu = menuItem.textContent;

  const topicContainer = menuItem.closest("[component='topics']");
  topicContainer.setAttribute("topic-target", refMenu.trim());
  loadTopic(topicContainer);
}
