import Cookies from "../../../helpers/cookies/index.js";

export async function mutate(request, response, payload) {
  const pathRoute = request.reference;
  const data = await response.json();
  if (request.method == "GET" && response.status == 200 && pathRoute)
    Cookies.set(
      pathRoute,
      JSON.stringify({
        data: data,
        payload: payload,
      })
    );

  return {
    status: response.status,
    data,
    url: response.url,
    payload: response.body,
  };
}
