import { closeModal, isLoading, setStep } from "./core/states.js";
import { getImage, getInput, getSnapshot, getStyledRules } from "./core/targets.js";

export const SnapshotModule = {
  setStep,
  isLoading,
  closeModal,
  getSnapshot,
  getImage,
  getStyledRules,
  getInput,
};
