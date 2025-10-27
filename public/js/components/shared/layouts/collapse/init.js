import { handleToggle } from "./core/states.js";
import { CollapseModule } from "./exports.js";

export const init = () => {
  const collapses = Array.from(
    document.querySelectorAll("[component='collapse']")
  );

  collapses.forEach((collapse) => {
    const headers = CollapseModule.getHeaders(collapse);

    headers.forEach((header) => header.addEventListener("click", handleToggle));
  });
};
