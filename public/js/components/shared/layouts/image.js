export const init = () => {
  const images = document.querySelectorAll("[component='image']");

  images.forEach((image) => {
    image.addEventListener("error", () => {
      console.log("images", images);
      const defaultSrc = image.getAttribute("default");

      image.setAttribute("src", defaultSrc);
    });
  });
};
