export function Button({
  name = "",
  text = "",
  type = "",
  placeholder = "",
  className = "",
  attributes = [],
  inner = "",
}) {
  const btn = document.createElement("button");
  
  btn.name = name;
  btn.textContent = text;
  btn.type = type;
  btn.className = className;
  btn.placeholder = placeholder;

  if (inner) btn.innerHTML = inner;

  attributes.map((attribute) =>
    btn.setAttribute(attribute.type, attribute.value)
  );

  return btn;
}
