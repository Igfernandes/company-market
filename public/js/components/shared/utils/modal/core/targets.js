export function getCloseButton(target = "") {
  const modal = document.querySelector(target);

  if (!modal) return;

  return modal.querySelector("[component='modal:close']");
}

export function getLeftButton(target = "") {
  const modal = document.querySelector(target);

  if (!modal) return;

  return modal.querySelector("[component='modal:left-btn']");
}

export function getRightButton(target = "") {
  const modal = document.querySelector(target);

  if (!modal) return;

  return modal.querySelector("[component='modal:right-btn']");
}