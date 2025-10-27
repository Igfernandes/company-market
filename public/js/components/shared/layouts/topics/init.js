import Storage from "../../../../libraries/storage/storage.js";
import { handleTargetTopics } from "./core/handles.js";
import { getMenuItems, getTopicSlideId } from "./core/targets.js";
import { loadTopic } from "./core/utils.js";

export const init = () => {
  const topicsContainer = document.querySelectorAll("[component='topics']");
  const storage = new Storage();
  topicsContainer.forEach((topicContainer) => {
    const topicSlideId = getTopicSlideId(topicContainer);

    const slides = window.slides[topicSlideId].slides;

    storage.save(topicSlideId, slides.map((slide) => slide.outerHTML));

    loadTopic(topicContainer);
    const menuItems = getMenuItems(topicContainer);

    menuItems.forEach((menuItem) =>
      menuItem.addEventListener("click", handleTargetTopics)
    );
  });
};
