// @ts-check

/**
 * Configurações de requisição Ajax
 * @typedef {Object} AjaxOptions
 * @property {string} [method] - Método HTTP (ex: "POST", "GET")
 * @property {Object} [headers] - Cabeçalhos da requisição
 * @property {any} [body] - Corpo da requisição
 */

/**
 * Resposta de requisição Ajax
 * @typedef {Object} AjaxResponse
 * @property {any} data - Dados retornados
 * @property {number} [status] - Código HTTP
 * @property {string} [url] - URL chamada
 */

/**
 * Instância de Ajax com métodos
 * @typedef {Object} AjaxInstance
 * @property {(route: string, payload?: Object, options?: AjaxOptions) => Promise<AjaxResponse>} custom - Requisição customizada
 * @property {(route: string, payload: Object, options?: AjaxOptions) => Promise<AjaxResponse>} post - Requisição POST
 * @property {(route: string, payload?: Object, options?: AjaxOptions) => Promise<AjaxResponse>} get - Requisição GET
 */
