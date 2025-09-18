export function show(selector) {
  const modal = document.querySelector(selector);

  if (!modal)
    throw new Error(
      `O modal referente ao seletor ${selector} não pode ser encontrado`
    );

  modal.classList.remove("hidden");

  return modal;
}
export function close(selector) {
  const modal = document.querySelector(selector);

  if (!modal)
    throw new Error(
      `O modal referente ao seletor ${selector} não pode ser encontrado`
    );

  modal.classList.add("hidden");

  return modal;
}

