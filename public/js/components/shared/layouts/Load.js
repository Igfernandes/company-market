export function Load(field) {
  const content = document.createElement("div");
  content.style.position = "absolute";
  content.style.width = "38px";
  content.style.bottom = "0px";
  content.style.right = "0px";
  content.className = "is-loading";

  const gif = document.createElement("img");
  gif.src = "/img/load-2.gif";
  gif.style.width = "100%";
  gif.style["object-fit"] = "contain";

  content.appendChild(gif);
  field.appendChild(content);

  return content;
}
