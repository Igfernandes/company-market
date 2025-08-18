/**
 * @returns {boolean}
 */
export function isLoadPage() {
  return performance.getEntriesByType("navigation")[0].type === "reload";
}
