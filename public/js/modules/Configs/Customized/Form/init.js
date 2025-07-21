import { CustomFields } from "./index.js";
import { locations } from "./locations.js";

export const init = async () => {
  const { content } = locations;
  const customFields = new CustomFields();

  if (!content) return;

  await customFields.execute();
};
