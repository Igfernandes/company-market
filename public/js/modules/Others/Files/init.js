import { ImagesPreview } from "./ImagesPreview.js";
import { NameFiles } from "./Name.js";
import { RemoveFiles } from "./Remove.js";
import { locations } from "./locations.js";
import { PreviewFiles } from "./Preview.js";

export const init = () => {
  const imagesPreview = new ImagesPreview();
  const nameFiles = new NameFiles();
  const removeFiles = new RemoveFiles();
  const previewFiles = new PreviewFiles();
  const { fieldsPreview, fieldsFiles, fielsRemove, filesPreview } = locations;

  filesPreview.forEach((field) => {
    field.addEventListener("click", previewFiles.handle);
  });

  fieldsPreview.forEach((field) => {
    field.addEventListener("change", imagesPreview.handle);
  });

  fieldsFiles.forEach((field) => {
    field.addEventListener("change", nameFiles.handle);
  });

  fielsRemove.forEach((group) => {
    const fields = group.querySelectorAll("[name]");
    fields.forEach((field) => {
      field.addEventListener("click", removeFiles.handle);
    });
  });
};
