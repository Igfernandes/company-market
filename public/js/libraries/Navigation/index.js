export function Navigation() {
  this.getParam = (param, url = "") => {
    if (!url) url = window.location.search;
    const urlParams = new URLSearchParams(url);

    return urlParams.get(param);
  };
  this.getQueryString = (url) => {
    const urlParams = new URL(url).searchParams;
    const queryMatriz = [...urlParams.entries()];
    const queryWithoutEndBars = queryMatriz.map(([k, v]) => [
      k,
      v.replace(/\/$/, ""),
    ]);
    
    return Object.fromEntries(queryWithoutEndBars);
  };
}
