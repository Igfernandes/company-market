export function Div({
  className = "",
  text = "",
  style = "",
  attributes = [],
}) {
  const div = document.createElement("div");
  div.className = className;
  div.textContent = text;
  div.style = style;

  attributes.map((attribute) =>
    div.setAttribute(attribute.type, attribute.value)
  );

  return div;
}
