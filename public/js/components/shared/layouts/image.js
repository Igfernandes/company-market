import { SkeletonModules } from "../utils/skeleton/exports.js";

export const init = () => {
  const images = document.querySelectorAll("[component='image']");

  images.forEach((image) => {
    SkeletonModules.isActive(image, true);
    image.addEventListener("error", () => {
      const defaultSrc = image.getAttribute("default");

      image.setAttribute("src", defaultSrc);
    });
    image.addEventListener("load", () => {
      SkeletonModules.isActive(image, false);
    });
  });
};
