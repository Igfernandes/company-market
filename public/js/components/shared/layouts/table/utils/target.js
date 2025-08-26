export function getTable(tableId) {
  return document.querySelector(
    `[component='table']${tableId ? "#" + tableId : ""}`
  );
}

export function getTableDeletes(entity) {
  return Array.from(
    document.querySelectorAll(
      `[component='table'] [data-delete-entity="${entity}"]`
    )
  );
}
