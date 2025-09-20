export function getTable(tableId) {
  return document.querySelector(
    `[component='table']${tableId ? "#" + tableId : ""}`
  );
}

export function getTableDeletes(tableId) {
  return Array.from(
    document.querySelectorAll(
      `[component='table']${tableId ? "#" + tableId : ""} [data-delete-entity]`
    )
  );
}

export function getDeleteKey(btnAction) {
  const attributeKey = "data-delete-key";
  let id = btnAction.getAttribute(attributeKey);

  if (!!id) return id;

  const fatherReference = btnAction.closest(`[${attributeKey}]`);
  id = fatherReference.getAttribute(attributeKey);

  if (!!id) return id;

  const ChildrenReference = btnAction.querySelector(`[${attributeKey}]`);
  id = ChildrenReference.getAttribute(attributeKey);

  return id;
}

export function getTableCheckbox(tableId) {
  return Array.from(
    document.querySelectorAll(
      `[component='table']${tableId ? "#" + tableId : ""} [target-checked]`
    )
  );
}

export function getCheckedRows(tableId) {
  const table = window.tables[tableId];

  return table
    .rows()
    .data()
    .toArray()
    .filter((row) => !!row._selected);
}
