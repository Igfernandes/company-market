import { HTTP_STATUS } from "../../../constants/http.js";
import Cookies from "../../../helpers/cookies/index.js";
/**
 * Trata a resposta de uma requisição fetch, armazena em cookies (GET + status 200),
 * e retorna um objeto com informações da resposta.
 *
 * @param {Object} request - Objeto com dados da requisição original.
 * @param {string} request.method - Método HTTP da requisição (ex: "GET", "POST").
 * @param {string} request.urlFetched - URL que foi requisitada.
 * @param {string} request.queryKey - Chave usada para armazenar dados em cache/cookies.
 * @param {Response} response - Objeto `Response` retornado pelo `fetch`.
 * @returns {Promise<Object>} Objeto com status, dados, URL e payload da resposta.
 */
export async function mutate(request, response) {
  const data = await response.json();

  if (request.method == "GET" && response.status == HTTP_STATUS.OK)
    Cookies.set(
      request.queryKey,
      JSON.stringify({
        data,
      })
    );
  else if (typeof Cookies.delete == "function")
    Cookies.delete(request.queryKey);

  return {
    status: response.status,
    data,
    url: response.url,
    payload: response.body,
  };
}
