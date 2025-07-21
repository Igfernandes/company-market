export function Span({text = '', className = '', attributes = []}){
    const span = document.createElement("span");
    span.textContent = text;
    span.className = className;

    attributes.map((attribute) => span.setAttribute(attribute.type, attribute.value))

    return span;
}