export function getUrlBase(url) {
  return url.split("public")[1];
}
export function redirect(url) {
  window.location.href = url;
}

export function getQueryParams(props = {}) {
  let query = "";

  for (const [name, value] of Object.entries(props)) {
    query += `${name}=${value}&`;
  }

  return query;
}
