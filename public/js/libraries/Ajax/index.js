import { HTTP_STATUS } from "../../constants/http.js";
import cookies from "../../helpers/cookies/index.js";
import { getQueryParams } from "../../helpers/route.js";
import { mutate } from "./libs/mutate.js";

/**
 * Classe responsável por realizar requisições HTTP com suporte a cache via cookies
 * e estrutura padronizada de resposta.
 *
 * @class
 */
const Ajax = function () {
  /**
   * Realiza uma requisição HTTP com método e cabeçalhos customizados.
   *
   * @async
   * @param {string} route - URL do endpoint.
   * @param {Object} [payload] - Dados enviados no corpo da requisição.
   * @param {Object} [options] - Configurações adicionais da requisição.
   * @param {string} [options.method="POST"] - Método HTTP a ser usado.
   * @param {Object} [options.headers] - Cabeçalhos da requisição.
   * @returns {Promise<Object>} Resposta processada pela função `mutate`.
   */
  this.custom = async (
    route,
    payload,
    options = {
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
    }
  ) => {
    const reference = [route];
    const request = options;

    if (payload) {
      request["body"] = JSON.stringify(payload);
      reference.push(payload);
    }

    const customResponse = await fetch(route, request);

    return await mutate(
      {
        ...request,
        urlFetched: route,
        queryKey: JSON.stringify(reference),
      },
      customResponse
    );
  };

  /**
   * Realiza uma requisição POST com dados no corpo da requisição.
   *
   * @async
   * @param {string} route - URL do endpoint.
   * @param {Object} payload - Dados enviados no corpo da requisição.
   * @param {Object} [options] - Configurações adicionais da requisição.
   * @param {Object} [options.headers] - Cabeçalhos da requisição.
   * @returns {Promise<Object>} Resposta processada pela função `mutate`.
   */
  this.post = async (
    route,
    payload,
    options = {
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
    }
  ) => {
    const reference = [route];
    const request = {
      method: "POST",
      body: payload,
      ...options,
    };

    if (payload) {
      reference.push(payload);
    }

    const postResponse = await fetch(route, request);

    return await mutate(
      {
        ...request,
        urlFetched: route,
        queryKey: JSON.stringify(reference),
      },

      postResponse
    );
  };

  /**
   * Realiza uma requisição GET com suporte a cache via cookies.
   *
   * @async
   * @param {string} route - URL base do endpoint.
   * @param {Object} payload - Parâmetros de consulta (query params).
   * @param {Object} [options] - Configurações adicionais da requisição.
   * @param {Object} [options.headers] - Cabeçalhos da requisição.
   * @returns {Promise<Object>} Dados do cache (cookies) ou da resposta processada pela função `mutate`.
   */
  this.get = async (
    route,
    payload,
    options = {
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
    }
  ) => {
    const url = `${route}/${getQueryParams(payload)}`;
    const request = {
      method: "GET",
      ...options,
    };

    const cookiesData = cookies.get(url);

    if (cookiesData)
      return {
        data: cookiesData.data,
        status: HTTP_STATUS.OK,
        url: route,
      };

    const getResponse = await fetch(url, request);

    return await mutate(
      {
        ...request,
        urlFetched: url,
        queryKey: url,
      },
      getResponse
    );
  };
};

export const ajax = new Ajax();
