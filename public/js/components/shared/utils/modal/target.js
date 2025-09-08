export function showModal(selector) {
  const modal = document.querySelector(selector);

  if (!modal)
    throw new Error(
      `O modal referente ao seletor ${selector} não pode ser encontrado`
    );

  modal.classList.remove("hidden");

  return modal;
}
