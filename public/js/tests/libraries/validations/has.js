import { Log } from "../feedback.js";

export function hasAttributesInElement(
  attributes = [],
  element = document.querySelector()
) {
  let hasAttributes = true;
  const elementName = element.getAttribute("component") ?? "Não Identificado";

  attributes.forEach((param) => {
    const hasAttributeInTable = element.getAttribute(param);

    if (hasAttributeInTable) return;

    Log("ERROR", {
      component: elementName,
      message: `O elemento ${param} do p${elementName} não pode ser encontrado`,
    });
    hasAttributes = false;
  });

  return hasAttributes;
}
export function hasElementsInComponent(
  elements = [],
  element = document.querySelector()
) {
  let hasElements = true;
  const elementName = element.getAttribute("component") ?? "Não Identificado";

  elements.forEach((param) => {
    const hasElementInTable = element.querySelector(param);

    if (hasElementInTable) return;

    Log("ERROR", {
      component: elementName,
      message: `O elemento ${param} do p${elementName} não pode ser encontrado`,
    });
    hasElements = false;
  });

  return hasElements;
}
