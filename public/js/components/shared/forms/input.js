export function Input({
  name = "",
  value = "",
  type = "",
  placeholder = "",
  className = "",
  attributes = [],
}) {
  const input = document.createElement("input");
  input.name = name;
  input.value = value;
  input.type = type;
  input.className = className;
  input.placeholder = placeholder;

  attributes.map((attribute) =>
  input.setAttribute(attribute.type, attribute.value)
  );

  return input;
}
