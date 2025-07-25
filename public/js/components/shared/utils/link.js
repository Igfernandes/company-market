export function Link({href ='#', className = '', text= '', style = '', target ="_self", attributes = []}){
    const a = document.createElement("a");
    a.href = href;
    a.className = className;
    a.textContent = text;
    a.style = style;
    a.target = target;

    attributes.map((attribute) => a.setAttribute(attribute.type, attribute.value))

    return a;
}