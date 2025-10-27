import { Snackbar } from "../../components/snackbar/index.js";
import { Clone } from "/js/main/effects/_clone.js";

export function MultipleFiles() {
  this.inputFiles = document.querySelector("[data-multiple='files']");

  this.init = () => {
    this.inputFiles.onchange = () => {
      this.addMultipleFiles();
    };
  };

  this.uploadMax = function (files) {
    const multipleFiles = [];

    for (const file of files) {
      if (file.size < 80048576) {
        multipleFiles.push(file);
      }
    }
    return multipleFiles;
  };

  this.addMultipleFiles = () => {
    const images = this.inputFiles.files;
    const clone = new Clone();
    const snackbar = new Snackbar();
    clone.init();

    const filesCurrent = document.querySelectorAll(
      "[data-clone='content']"
    ).length;

    const multipleFiles = this.uploadMax(images);

    if (filesCurrent + multipleFiles.length > 60)
      return snackbar.show(
        "failed",
        "O máximo de upload é 60 arquivos por vez."
      );

    if (multipleFiles.length > 0) {
      multipleFiles.map((file, key) => {
        const pos = clone.duplicate();
        const inputFile = document.querySelector(
          `[name='block[${pos}][foto]']`
        );
        const container = new DataTransfer();
        container.items.add(images[key]);
        inputFile.files = container.files;
        const contentImg = inputFile.closest(".form-upload");
        contentImg.querySelector("img").src = URL.createObjectURL(file);
      });
    }

    this.addMultipleFiles.value = "";
  };
}

export const init = () => {
  const cmd = new MultipleFiles();

  if (cmd.inputFiles) {
    cmd.init();
  }
};
