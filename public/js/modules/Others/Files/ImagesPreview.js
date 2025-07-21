export function ImagesPreview() {
  this.handle = (ev) => {
    const filePreview = ev.currentTarget;
    const [file] = filePreview.files;
    const image = filePreview.dataset.preview;

    if (!file) return false;

    document.querySelector(`[data-target-preview='${image}']`).src =
      URL.createObjectURL(file);
    const textPreview = document.querySelector(
      `[data-label-preview='${image}']`
    );

    if (textPreview) textPreview.innerText = file.name;
  };
}
