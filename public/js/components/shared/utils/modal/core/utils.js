import { getModal } from "./targets.js";

export function show(targetModal) {
  const modal = getModal(targetModal);

  if (!modal)
    throw new Error(
      `O modal referente ao seletor ${targetModal} não pode ser encontrado`
    );

  modal.classList.remove("hidden");

  return modal;
}
export function close(targetModal) {
  const modal = getModal(targetModal);

  if (!modal)
    throw new Error(
      `O modal referente ao seletor ${targetModal} não pode ser encontrado`
    );

  modal.classList.add("hidden");

  return modal;
}
