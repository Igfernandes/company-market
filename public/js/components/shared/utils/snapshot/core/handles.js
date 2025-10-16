import { optimizeImage } from "../../../../../helpers/files.js";
import { ajax } from "../../../../../libraries/Ajax/index.js";
import { snackbar } from "../../snackbar.js";
import { SnapshotModule } from "../exports.js";
import { removeStyledRules } from "./states.js";

export const handleUploadFile = async (ev) => {
  const element = ev.target;
  const file = element.files[0];
  const snapshot = element.closest("[component='snapshot']");
  const snapshotIndex = snapshot.getAttribute("snapshot-target");
  SnapshotModule.isLoading(snapshot, true);

  element.disables = true;

  const imageOptimized = await optimizeImage(file);
  const imageUrl = URL.createObjectURL(imageOptimized);

  window.snapshot[snapshotIndex].config.source = imageUrl;
  window.snapshot[snapshotIndex].render();

  setTimeout(() => {
    SnapshotModule.setStep(
      SnapshotModule.getSnapshot(snapshotIndex),
      "preview"
    );

    SnapshotModule.isLoading(snapshot, false);
  }, 2000);
};

export const handleCloseModal = (ev) => {
  const snapshotComponent = ev.target.closest("[component='snapshot']");
  SnapshotModule.closeModal(snapshotComponent);
};

export const handleSave = async (editedImageObject, snapshotComponent) => {
  const apiUrl = snapshotComponent.getAttribute("snapshot-fetch");
  const operation =
    snapshotComponent.getAttribute("snapshot-operation") ?? "photo";

  if (!apiUrl) return true;

  const { data } = await ajax.custom(
    apiUrl,
    {
      data: {
        file: editedImageObject,
      },
      operation,
    },
    {
      method: "PATCH",
    }
  );

  if (!data)
    snackbar.execute("FAIL", {
      title: "",
    });

  SnapshotModule.closeModal(snapshotComponent);
  const image = SnapshotModule.getImage(snapshotComponent);

  image.src = data.file;
  return false;
};

export const handleFail = (filerobotImageEditor) => {
  snackbar.execute("FAIL", {
    title: "Editor de Imagem",
    message:
      "O correu um problema no editor de imagens. Recarregue e tente novamente",
  });
  filerobotImageEditor.terminate();
  removeStyledRules();
};

export const handleBeforeSave = () => {
  const head = document.head;
  const style = document.createElement("style");
  style.id = "snapshot_rules";
  style.innerHTML =
    ".FIE_save-extension-selector, .FIE_save-resize-wrapper{ display: none }";

  head.appendChild(style);
};
