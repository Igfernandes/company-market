import { init as initToggle } from "../toggle.js";
import { init as initCriteria } from "./criteria.js";

export const init = () => {
  initToggle();
  initCriteria();
};
