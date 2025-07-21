import { ClearUrl } from "./index.js";
import { locations } from "./locations.js";

export const init = () => {
  const { errorModal, responseModal } = locations;
  const clearUrl = new ClearUrl();
  if (!errorModal && !responseModal) return;

  errorModal.on("hidden.bs.modal", clearUrl.handle);
  responseModal.on("hidden.bs.modal", clearUrl.handle);
};
