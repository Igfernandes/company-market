import { capitalize } from "/js/helpers/string.js";
import { getTHdTexts, isColumn } from "../utils/columns.js";
import { handleRenderActions } from "./columns.js";
import { INDEXES } from "../../../../../constants/indexes.js";

export function tableRender(tableContainer) {
  const { updateAction, deleteAction } = tableContainer.dataset;
  const settings = [];
  const tHeads = getTHdTexts(tableContainer);

  const dateReference = new Date().getTime();

  const statusColumn = (data) => {
    if (!data) return data;

    const colValue = data.toLowerCase();

    return `<div class='text-center'>
      <span class="inline-block h-100 w-100 bg-${
        INDEXES[colValue]
      }">${capitalize(colValue)}
      </span>
    </div>`;
  };

  const idColumn = (id) => {
    if (!id) return id;

    return `<div>
    <input id='table_id_${dateReference}_${id}' name='table_id[]' value='${id}' type='checkbox' class='mr-2' />
    <label for='table_id_${dateReference}_${id}' class='cursor-pointer'>${id}</label>
    </div>`;
  };

  const handleRender = (data, type, row, meta) => {
    if (isColumn("status", meta, tableContainer)) {
      return statusColumn(data);
    } else if (isColumn("id", meta, tableContainer)) {
      return idColumn(data);
    }

    return data;
  };

  if (updateAction || deleteAction) {
    const actions = handleRenderActions(tHeads.length, {
      updateAction,
      deleteAction,
      tableContainer,
    });
    if (actions) settings.push(actions);
  }

  return {
    columns: [
      ...tHeads.map((tHd, key) => ({
        data: key,
        title: tHd,
      })),
      ...settings,
    ],
    columnDefs: [
      {
        targets: "_all", // vamos redefinir depois dinamicamente
        render: handleRender,
      },
    ],
  };
}
