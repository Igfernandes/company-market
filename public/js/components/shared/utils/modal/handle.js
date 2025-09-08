import { showModal } from "./target.js";

export function handleDeleteModal(ev) {
  const btn = ev.target;
  const modal = btn.closest("[component='modal']");

  modal.remove();
}

export function handleCloseModal(ev) {
  const btn = ev.target;
  const modal = btn.closest("[component='modal']");

  modal.classList.add("hidden");
}

export function handleToggleModal(ev) {
  const btn = ev.target;
  const modal = btn.getAttribute("modal-target");

  showModal(`[modal='${modal}']`);
}
