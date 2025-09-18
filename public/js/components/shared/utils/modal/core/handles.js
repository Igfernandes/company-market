import { getButtonElement } from "../../../forms/button/target.js";
import { MODAL_ID } from "./constants.js";
import { ModalsModule } from "../exports.js";

export function handleDeleteModal(ev) {
  const btn = getButtonElement(ev);
  const modal = btn.closest(MODAL_ID);

  modal.remove();
}

export function handleCloseModal(ev) {
  const btn = getButtonElement(ev);
  const modal = btn.closest(MODAL_ID);

  modal.classList.add("hidden");
}

export function handleToggleModal(ev) {
  const btn = getButtonElement(ev);
  const modalSelector = btn.getAttribute("modal-target");

  ModalsModule.show(`[modal='${modalSelector}']`);
}
