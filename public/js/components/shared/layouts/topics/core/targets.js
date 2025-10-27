export function getMenuItems(topicContainer = document.querySelector()) {
  return topicContainer.querySelectorAll("[component='topics:menu-item']");
}
export function getTopics(topicContainer = document.querySelector()) {
  return topicContainer.querySelectorAll("[component='topic']");
}
export function getTopicsSlide(topicContainer = document.querySelector()) {
  return Array.from(topicContainer.querySelectorAll(".swiper-slide"));
}
export function getTopicSlideId(topicContainer = document.querySelector()) {
  return topicContainer
    .querySelector("[component='slides:container']")
    .getAttribute("id");
}
