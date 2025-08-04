import { Snackbar } from "../../components/shared/utils/snackbar.js";
import { HTTP_STATUS } from "../../constants/http.js";
import cookies from "../../helpers/cookies/index.js";
import { translate } from "../../translate/index.js";
import { mutate } from "./libs/mutate.js";

const Ajax = function () {
  this.custom = async (
    route,
    payload,
    options = {
      action: true,
      method: "POST",
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      reference: null,
    }
  ) => {
    const { method, headers, reference } = options;

    if (route.substr(-1) == "/") route = route.substring(0, route.length - 1);

    const request = {
      method,
      body: JSON.stringify(payload),
      headers,
    };
    const customResponse = await fetch(route, request);
    return await mutate(
      {
        ...request,
        urlFetched: route,
        reference,
      },
      customResponse,
      payload
    );
  };

  this.post = async (
    route,
    payload,
    options = {
      action: true,
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      reference: null,
    }
  ) => {
    try {
      const { headers, reference } = options;
      const snackbar = new Snackbar();

      const request = {
        method: "POST",
        body:
          options.headers &&
          options.headers["Content-type"].includes(
            "application/json; charset=UTF-8"
          )
            ? JSON.stringify(payload)
            : payload,
        headers,
        reference,
      };

      if (route.substr(-1) == "/") route = route.substring(0, route.length - 1);

      const postResponse = await fetch(route, request);

      if (postResponse.status == HTTP_STATUS.NOT_FOUND) {
        snackbar.execute("NOTICE", {
          title: "Erro",
          message: translate("Screens.default.service_error"),
        });
        throw new Error("ERROR IN SERVICE: " + route);
      }

      return await mutate(
        {
          ...request,
          urlFetched: route,
          reference,
        },
        postResponse,
        payload
      );
    } catch (err) {
      console.log(err.message);
    }
  };

  this.get = async (
    route,
    payload,
    options = {
      payload: {},
      headers: {
        "Content-type": "application/json; charset=UTF-8",
      },
      reference: null,
    }
  ) => {
    let params = "?";
    const { headers, reference } = options;

    if (payload)
      Object.entries(payload).forEach(([label, value], key) => {
        if (!value) return;

        params += key != 0 ? "&" : "";
        params += `${label}=${value}`;
      });

    const request = {
      method: "GET",
      headers,
    };
    const cookiesData = cookies.get(reference);

    if (cookiesData && cookiesData.payload == JSON.stringify(payload))
      return cookiesData.data;

    const urlFetched = route + params;
    const getResponse = await fetch(urlFetched, request);

    return await mutate(
      {
        ...request,
        queryStrings: params,
        urlFetched,
        reference,
      },
      getResponse,
      payload
    );
  };
};

export { Ajax };
