export function getUrlBase(url) {
  return url.split("public")[1];
}
export function redirect(url) {
  window.location.href = url;
}
