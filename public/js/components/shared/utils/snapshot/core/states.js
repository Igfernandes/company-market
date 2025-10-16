import { resetFileInput } from "../../../../../helpers/files.js";
import { ModalsModule } from "../../modal/exports.js";
import { SnapshotModule } from "../exports.js";

export function setStep(snapshot = document.querySelector(), step = "") {
  if (!snapshot) console.warn("Não foi possível encontrar o snapshot desejado");

  const snapshotModal = snapshot.querySelector("[component='snapshot-modal']");
  snapshotModal.setAttribute("snapshot-step", step);
}

export function isLoading(
  snapshot = document.querySelector(),
  isLoading = false
) {
  if (!snapshot) console.warn("Não foi possível encontrar o snapshot desejado");

  const snapshotModal = snapshot.querySelector("[component='snapshot-modal']");
  snapshotModal.setAttribute("snapshot-loading", isLoading);
}

export const closeModal = (snapshot = document.querySelector()) => {
  const snapshotIndex = snapshot.getAttribute("snapshot-target");

  ModalsModule.close(`snapshot_${snapshotIndex}`);
  SnapshotModule.setStep(snapshot, "upload");
  resetFileInput(SnapshotModule.getInput(snapshot));
  removeStyledRules();
};

export const removeStyledRules = () => {
  const styledRules = SnapshotModule.getStyledRules();
  if (styledRules) styledRules.remove();
};
