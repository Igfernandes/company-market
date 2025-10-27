export const init = () => {
  const videos = document.querySelectorAll("[component='video']");

  videos.forEach((video) => {
    video.addEventListener("ended", () => {
      video.currentTime = 0;
      video.play();
    });
  });
};
