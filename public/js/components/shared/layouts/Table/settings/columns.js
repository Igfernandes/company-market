import { getColumnIndex } from "../utils/columns.js";

export const handleRenderUpdate = (id, updateAction) => {
  if (!id) return "";

  return `<a class='t-btn-update text-white-500 bg-accent py-2 pl-2 pr-1 rounded-xs mr-2'
     href="${updateAction}/${id}">
      <i class="bi bi-pencil-square"></i>
    </a>
  `;
};
export const handleRenderDelete = (id, deleteAction) => {
  if (!id) return "";

  return `<span class='t-btn-delete text-white-500 bg-accent p-2 rounded-xs' data-delete-entity="${deleteAction}" data-delete-key="${id}">
    <i class="bi bi-trash"></i>
    </span>
  `;
};

export const handleRenderActions = (
  index,
  { updateAction, deleteAction, tableContainer }
) => {
  const indexColumnId = getColumnIndex("id", tableContainer);
  
  if (!indexColumnId) return;

  return {
    data: index, // <- sem ligação com dados
    title: "Ações",
    defaultContent: "", // ou pode deixar em branco
    orderable: false,
    searchable: false,
    render: function (data, type, row) {
      return `
          <div class="tb-actions">
          ${handleRenderUpdate(row[indexColumnId], updateAction)}
          ${handleRenderDelete(row[indexColumnId], deleteAction)}
          </div>`;
    },
  };
};
