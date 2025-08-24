import { HTTP_STATUS } from "../../constants/http.js";
import cookies from "../../helpers/cookies/index.js";
import { getQueryParams } from "../../helpers/route.js";
import { mutate } from "./libs/mutate.js";

const isFirstFetch = {};

/**
 * @developer Fernandes(github: https://github.com/Igfernandes)
 *
 * Ajax: Open source elaborado para ser uma tecnologia de solicitações e gerenciamento de requisições.
 * version: 1.0.0
 */

/** @type {AjaxInstance} */
export const ajax = {
  custom: async (
    route,
    payload,
    options = {
      method: "POST",
    }
  ) => {
    const reference = [route];
    const request = options;

    if (payload) {
      request["body"] = JSON.stringify(payload);
      reference.push(payload);
    }

    const customResponse = await fetch(route, request);

    if (customResponse.status === HTTP_STATUS.NOT_FOUND)
      throw new Error("INVALID ROUTE OR OPERATION");

    return await mutate(
      {
        ...request,
        method: options.method ?? "POST",
        urlFetched: route,
        queryKey: JSON.stringify(reference),
      },
      customResponse
    );
  },

  post: async (route, payload, options = {}) => {
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

    if (postResponse.status === HTTP_STATUS.NOT_FOUND)
      throw new Error("INVALID ROUTE OR OPERATION");

    return await mutate(
      {
        ...request,
        urlFetched: route,
        queryKey: JSON.stringify(reference),
      },

      postResponse
    );
  },
  get: async (route, payload, options = {}) => {
    const url = `${route}/${getQueryParams(payload)}`;
    const request = {
      method: "GET",
      ...options,
    };

    const cookiesData = cookies.get(url);

    if (cookiesData && !!isFirstFetch[route])
      return {
        data: cookiesData.data,
        status: HTTP_STATUS.OK,
        url: route,
      };

    const getResponse = await fetch(url, request);

    isFirstFetch[route] = true;
    return await mutate(
      {
        ...request,
        urlFetched: url,
        queryKey: url,
      },
      getResponse
    );
  },
};
