import { getColumnIndex } from "../utils/columns.js";

export const handleRenderUpdate = (id, updateAction) => {
  if (!id || !updateAction) return "";

  return `<a class='t-btn-update text-white-500 bg-accent py-2 pl-2 pr-1 rounded-xs mr-2'
     href="${updateAction}/${id}">
      <i class="bi bi-pencil-square"></i>
    </a>
  `;
};
export const handleRenderDelete = (id, deleteAction) => {
  if (!id || !deleteAction) return "";

  return `<span class='t-btn-delete text-white-500 bg-accent p-2 rounded-xs cursor-pointer' data-delete-entity="${deleteAction}" data-delete-key="${id}">
    <i class="bi bi-trash"></i>
    </span>
  `;
};

export const handleRenderOptions = (id, strOptions) => {
  if (!id || !strOptions) return "";

  const options = JSON.parse(strOptions);

  return `
  <div class='dots relative inline-block ml-3'>
    <i class="bi bi-three-dots-vertical text-lg"></i> 
    <ul class="absolute bg-white rounded-md z-30 shadow right-20 bottom-10">
        ${options
          .map(
            (option) =>
              `<li class="hover:bg-accent hover:text-white px-4 py-2 my-1 cursor-pointer" 
            option-ref='${option.key ?? ""}'
            option-key='${id}'>${option.title ?? ""}</li>`
          )
          .join("")}
    </ul>
  </div> 
  `;
};

export const handleRenderActions = ({
  updateAction,
  deleteAction,
  tableContainer,
}) => {
  const indexColumnId = getColumnIndex("id", tableContainer);

  if (indexColumnId == -1) return;

  const strOptions = tableContainer.getAttribute("options");

  return {
    data: "actions", // <- sem ligação com dados
    title: "Ações",
    defaultContent: "", // ou pode deixar em branco
    orderable: false,
    searchable: false,
    render: function (data, type, row) {
      return `
          <div class="tb-actions">
          ${handleRenderUpdate(row[indexColumnId], updateAction)}
          ${handleRenderDelete(row[indexColumnId], deleteAction)}
          ${handleRenderOptions(row[indexColumnId], strOptions)}
          </div>`;
    },
  };
};
