export function getButtonElement(ev) {
  const element = ev.target;

  if (element.tagName.toLowerCase() == "button") return element;

  const btn = element.closest("button");

  return btn;
}
