export function Image({
  alt = "",
  className = "",
  text = "",
  style = "",
  attributes = [],
  ...data
}) {
  const src = document.createElement("img");
  src.src = data.src;
  src.alt = alt;
  src.className = className;
  src.textContent = text;
  src.style = style;

  attributes.map((attribute) =>
    src.setAttribute(attribute.type, attribute.value)
  );

  return src;
}
