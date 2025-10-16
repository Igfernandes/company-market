import { ModalsModule } from "../modal/exports.js";
import { Snapshot } from "./core/index.js";
import { locations } from "./locations.js";

export function init() {
  const snapshot = new Snapshot();
  const { snapshots: snapshotComponents } = locations;

  snapshotComponents.forEach((component) => {
    const snapshotImage = component.querySelector(
      '[component="snapshot:image"]'
    );
    const snapshotIndex = component.getAttribute("snapshot-target");

    snapshotImage.addEventListener("click", () => {
      ModalsModule.show(`snapshot_${snapshotIndex}`);
      
      return false;
    });
    const editor = component.querySelector(
      "[component='snapshot-modal:preview']"
    );
    snapshot.editor(editor);
    snapshot.inicialize(component);
  });
}
