export function Option({value = '', selected = false, className = '', text = ''}){
    const option = document.createElement("option");
    option.className = className
    option.value = value;
    option.textContent = text;
    option.selected = selected

    return option;
}