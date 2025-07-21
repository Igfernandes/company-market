import { Facebook } from "./index.js";
import { locations } from "./locations.js";
import { facebookInstance } from "./utils/facebookInstance.js";

export const init = async () => {
  const { btnFacebook } = locations;
  await facebookInstance();
  const facebook = new Facebook();

  btnFacebook.addEventListener("click", facebook.handle);
};
