/**
 * @returns {boolean}
 */
export function isLoadPage() {
  return performance.getEntriesByType("navigation")[0].type === "reload";
}

export function openPage(link) {
  window.open(link, "_blank");
}
