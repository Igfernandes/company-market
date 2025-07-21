export const isPage = (page = "") => {
  return !!document.querySelector(`[target-page='${page}']`);
};
