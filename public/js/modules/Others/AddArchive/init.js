import { AddArchive } from "./index.js";
import { locations } from "./locations.js";

export const init = () => {
  const addArchive = new AddArchive();
  const { groups } = locations;

  groups.forEach((group) => {
    group.addEventListener("click", addArchive.handle);
  });
};
