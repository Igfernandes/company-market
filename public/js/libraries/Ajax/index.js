import { HTTP_STATUS } from "../../constants/http.js";
import cookies from "../../helpers/cookies/index.js";
import { getQueryParams } from "../../helpers/route.js";
import { mutate } from "./libs/mutate.js";

const isFirstFetch = {};

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

    return await mutate(
      {
        ...request,
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
