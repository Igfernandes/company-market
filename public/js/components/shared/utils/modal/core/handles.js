import { MODAL_REF } from "./constants.js";
import { ModalsModule } from "../exports.js";
import { FormModules } from "../../../forms/exports.jS";

export function handleDeleteModal(ev) {
  const btn = FormModules.button(ev);
  const modal = btn.closest(MODAL_REF);

  modal.remove();
}

export function handleCloseModal(ev) {
  const btn = FormModules.button(ev);
  const modal = btn.closest(MODAL_REF);

  modal.classList.add("hidden");
}

export function handleToggleModal(ev) {
  const btn = FormModules.button(ev);
  const modalSelector = btn.getAttribute("modal-target");

  ModalsModule.show(modalSelector);
}
