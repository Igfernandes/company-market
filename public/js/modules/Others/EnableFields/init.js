import { EnableFields } from "./index.js";
import { locations } from "./locations.js";

export const init = () => {
  const enableFields = new EnableFields();
  const { groups } = locations;

  groups.forEach((group) => {
    const fields = group.querySelectorAll("[name]");
    fields.forEach((field) => {
      field.addEventListener("click", enableFields.handle);
    });
  });
};
