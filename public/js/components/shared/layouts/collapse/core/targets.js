export function getHeaders(collapseContainer = document.querySelector()) {
  return Array.from(
    collapseContainer.querySelectorAll("[component='collapse:header']")
  );
}
