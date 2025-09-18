export function hydrateForm(formSelector, payload = {}) {
  const form = document.querySelector(formSelector);

  if (!form)
    return console.warn(`O formulário ${formSelector} não pode ser encontrado`);

  Object.entries(payload).forEach(([key, value]) => {
    const field = form.elements[key];
    if (!field) return;

    field.placeholder = value;
    field.value = value;
    field.dispatchEvent(new Event("keyup", { bubbles: true }));
  });

  return form;
}
