import Storage from "../../../../../libraries/storage/storage.js";
import { getTopicSlideId } from "./targets.js";

export function loadTopic(topicContainer = document.querySelector()) {
  const targetTopic = topicContainer.getAttribute("topic-target");

  storeSlideTopics(topicContainer, targetTopic);
}

export function storeSlideTopics(topicContainer, targetRef) {
  const storage = new Storage();

  const slideWrapper = topicContainer.querySelector(".swiper-wrapper");
  const topicSlideId = getTopicSlideId(topicContainer);
  const topicsHistoric = storage.select(topicSlideId);

  slideWrapper.innerHTML = topicsHistoric
    .filter((topic) => topic.indexOf(targetRef) > -1)
    .join("");
}
