export function getField(form, { name, value, ref }) {
  const valueReference = value ? `[value='${value}']` : "";
  let field;

  if (ref) field = form.querySelector(`[data-ref='${ref}']${valueReference}`);
  else field = form.querySelector(`[name='${name}']${valueReference}`);

  if (!field)
    throw new Error(
      `Não foi possível encontrar o campo: ${name}. error_validation`
    );

  return field;
}

export function isFieldExecutable(field) {
  return !(field.disabled == true);
}
