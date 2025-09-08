import { capitalize } from "/js/helpers/string.js";
import { getTHdTexts, isColumn } from "../utils/columns.js";
import { handleRenderActions } from "./columns.js";
import { INDEXES } from "../../../../../constants/indexes.js";
import "../utils/handle.js";

export function tableRender(tableContainer) {
  const { updateAction, deleteAction } = tableContainer.dataset;
  const settings = [];
  const tHeads = getTHdTexts(tableContainer);
  const tabRef = window.tables[tableContainer.getAttribute("id")];

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

  const checkboxColumn = (id) => {
    if (!id) return id;

    return `<div class='flex items-center'>
    <input id='table_id_${dateReference}_${id}' onchange='handleChecked(event)' target-checked name='table_id[]' value='${id}' type='checkbox' class='checkbox cursor-pointer rounded-xs appearance-none border-2 border-gray-700 p-2 mr-2' />
    <label for='table_id_${dateReference}_${id}' class='cursor-pointer'>${id}</label>
    </div>`;
  };

  const handleRender = (data, type, row, meta) => {
    const isChecked = tableContainer.getAttribute("checked");

    if (isColumn("status", meta, tableContainer)) {
      return statusColumn(data);
    } else if (isChecked && isColumn("id", meta, tableContainer)) {
      return checkboxColumn(data);
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
