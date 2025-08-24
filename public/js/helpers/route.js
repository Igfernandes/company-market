/**
 * Retorna a parte da URL após o segmento "public".
 *
 * @param {string} url - URL completa que contém o segmento "public".
 * @returns {string} Parte da URL após "public".
 */
export function getUrlBase(url) {
  return url.split("public")[1];
}

/**
 * Redireciona o usuário para uma nova URL.
 *
 * @param {string} url - URL de destino para redirecionamento.
 */
export function redirect(url) {
  window.location.href = url;
}

/**
 * Constrói uma query string a partir de um objeto de pares chave-valor.
 *
 * @param {Object.<string, string|number|boolean>} [props={}] - Objeto com os parâmetros de query.
 * @returns {string} Query string formatada (exemplo: "foo=1&bar=2&").
 */
export function getQueryParams(props = {}) {
  let query = "";

  for (const [name, value] of Object.entries(props)) {
    query += `${name}=${value}&`;
  }

  return query;
}

/**
 * Converte um objeto FormData em um objeto JSON.
 * Se a chave se repete, transforma os valores em um array.
 *
 * @param {FormData} formData - Instância de FormData.
 * @returns {Object.<string, string|string[]>|Object} Objeto JSON equivalente ao FormData.
 */
export function getFormDataToJson(formData) {
  const obj = {};
  formData.forEach((value, key) => {
    if (obj[key]) {
      if (Array.isArray(obj[key])) {
        obj[key].push(value);
      } else {
        obj[key] = [obj[key], value];
      }
    } else {
      obj[key] = value;
    }
  });
  return obj;
}

export function getParams(url, data) {
  let urlWithParam = url;

  if (data && Object.keys(data).length > 0) {
    Object.entries(data).forEach(([label, value]) => {
      urlWithParam = value
        ? urlWithParam.replaceAll(`{${label}}`, value)
        : urlWithParam.replaceAll(`{${label}}`, "");
    });
    urlWithParam = urlWithParam.includes("//")
      ? urlWithParam.replaceAll("//", "/")
      : urlWithParam;
  }

  // SE AINDA HOUVER ALGUM PARAMETRO QUE NAO FOI SUBSTITUIDO, REMOVER (REMOVE TUDO DENTRO DAS CHAVES INCLUINDO AS CHAVES)
  urlWithParam = urlWithParam.replace(/ *\{[^)]*\} */g, "");

  return urlWithParam;
}
