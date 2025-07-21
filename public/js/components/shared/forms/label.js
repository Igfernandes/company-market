export function Label({ className = "", attributes = [], text }) {
  const label = document.createElement("label");
  label.className = className;
  label.textContent = text;

  attributes.map((attribute) =>
    label.setAttribute(attribute.type, attribute.value)
  );

  return label;
}
