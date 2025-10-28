export function setDeepValue(obj, keys, value) {
  let current = obj;
  for (let i = 0; i < keys.length; i++) {
    const key = keys[i];
    const isLast = i === keys.length - 1;

    if (isLast) {
      // se já existe a chave e não é array, e chega outro valor, transforma em array
      if (current[key] !== undefined) {
        if (Array.isArray(current[key])) {
          current[key].push(value);
        } else {
          current[key] = [current[key], value];
        }
      } else {
        current[key] = value;
      }
    } else {
      // cria container intermediário se não existir
      if (!current[key] || typeof current[key] !== "object") {
        current[key] = {};
      }
      current = current[key];
    }
  }
}
