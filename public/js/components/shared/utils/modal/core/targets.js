export function getCloseButton(target = "") {
  const modal = getModal(target);

  if (!modal) return;

  return modal.querySelector("[component='modal:close']");
}

export function getLeftButton(target = "") {
  const modal = getModal(target);

  if (!modal) return;

  return modal.querySelector("[component='modal:left-btn']");
}

export function getRightButton(target = "") {
  const modal = getModal(target);

  if (!modal) return;

  return modal.querySelector("[component='modal:right-btn']");
}

export function getModal(targetModal) {
  return typeof targetModal == "string"
    ? document.querySelector(`[modal='${targetModal}']`)
    : targetModal;
}
