import {
  handleBeforeSave,
  handleCloseModal,
  handleFail,
  handleSave,
  handleUploadFile,
} from "./handles.js";
import { SETTINGS } from "../settings.js";
import { ModalsModule } from "../../modal/exports.js";

export function Snapshot() {
  this.inicialize = (snapshot) => {
    const input = snapshot.querySelector("input[type='file']");
    input.addEventListener("change", handleUploadFile);

    ModalsModule.getCloseButton(
      `snapshot_${snapshot.getAttribute("snapshot-target")}`
    ).addEventListener("click", handleCloseModal);
  };

  this.editor = (snapshotModal) => {
    const filerobotImageEditor = new FilerobotImageEditor(
      snapshotModal,
      SETTINGS
    );

    const snapshotComponent = snapshotModal.closest("[component='snapshot']");
    const index = snapshotComponent.getAttribute("snapshot-target");

    filerobotImageEditor.render({
      onBeforeSave: handleBeforeSave,
      onSave: (editedImageObject) =>
        handleSave(editedImageObject, snapshotComponent),
      onClose: () => handleFail(filerobotImageEditor),
    });

    if (!window.snapshot) window.snapshot = {};

    window.snapshot[index] = filerobotImageEditor;
  };
}
