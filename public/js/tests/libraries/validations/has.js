export function hasAttributesInElement(
  attributes = [],
  element = document.querySelector()
) {
  let hasError = false;
  const elementName = element.getAttribute("component") ?? "Não Identificado";

  attributes.forEach((param) => {
    const hasElementInTable = element.querySelector(param);

    if (hasElementInTable) return;

    Log("ERROR", {
      component: elementName,
      message: `O elemento ${param} do p${elementName} não pode ser encontrado`,
    });
    hasError = true;
  });

  return hasError;
}
