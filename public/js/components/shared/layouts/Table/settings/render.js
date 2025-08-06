import { capitalize } from "../../../../../helpers/string.js";
import { getTHdTexts, isColumn } from "../utils/columns.js";
import { handleRenderActions } from "./columns.js";

export function tableRender(tableContainer) {
  const { updateAction, deleteAction } = tableContainer.dataset;
  const settings = [];
  const tHeads = getTHdTexts(tableContainer);

  const columnStatus = (data) => {
    if (!data) return data;

    const colValue = data.toLowerCase();

    return `<span class="inline-block h-100 w-100 bg-${colValue}">${capitalize(
      colValue
    )}</span>`;
  };

  const handleRender = (data, type, row, meta) => {
    if (isColumn("status", meta, tableContainer)) {
      return columnStatus(data);
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
