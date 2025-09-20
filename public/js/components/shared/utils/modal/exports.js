import { MODAL_REF } from "./core/constants.js";
import { isLoading } from "./core/states.js";
import {
  getCloseButton,
  getLeftButton,
  getModal,
  getRightButton,
} from "./core/targets.js";
import { close, show } from "./core/utils.js";

export const ModalsModule = {
  show,
  close,
  getCloseButton,
  getLeftButton,
  getRightButton,
  getModal,
  isLoading,
  id: MODAL_REF,
};
