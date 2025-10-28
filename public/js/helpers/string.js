export function capitalize(word) {
  return word
    .split(" ")
    .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
    .join(" ");
}


export function splitByBrackets(str) {
  const parts = [];
  const regex = /([^\[\]]+)|\[(.*?)\]/g;
  let match;

  while ((match = regex.exec(str)) !== null) {
    // match[1] = texto fora de colchetes
    // match[2] = conteúdo dentro dos colchetes
    parts.push(match[1] ?? match[2]);
  }

  return parts;
}
