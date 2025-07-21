import { PasswordVisibility } from "./index.js";
import { locations } from "./locations.js";

export const init = () => {
  const { event } = locations;
  const passwordVisibility = new PasswordVisibility();

  event.forEach((btn) => {
    if (btn) btn.addEventListener("click", passwordVisibility.handle);
  });
};
