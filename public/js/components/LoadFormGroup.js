export function LoadFormGroup(field){
    const content = document.createElement("div")
    content.style.position = "absolute"
    content.style.width = "38px";
    content.style.bottom = "0px";
    content.style.right = "0px";
    content.className = "is-loading"

    const gif = document.createElement("img");
    gif.src = '/img/load-2.gif'
    gif.style.width = "100%";
    gif.style["object-fit"] ="contain";
       
    content.appendChild(gif);
    const group = field.closest(".form-group");

    if(!group) return console.log(`Não foi possível carregar o icon do load para '${field.name}'`);

    group.style = "position: relative"
    group.appendChild(content);

    return content;
}