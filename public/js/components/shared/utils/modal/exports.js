import { MODAL_ID } from "./core/constants.js";
import {
  getCloseButton,
  getLeftButton,
  getRightButton,
} from "./core/targets.js";
import { close, show } from "./core/utils.js";

export const ModalsModule = {
  show,
  close,
  getCloseButton,
  getLeftButton,
  getRightButton,
  id: MODAL_ID,
};
