import "../../../../libraries/DataTables/dataTables.js";
import { tableAjax } from "./utils/ajax.js";
import { translatorTable } from "./utils/translator.js";

export const init = () => {
  const tableContainers = document.querySelectorAll("[component='table']");

  tableContainers.forEach((tableContainer) => {
    const table = tableContainer.querySelector("table");
    const { page } = table.dataset;

    const tableId = table.getAttribute("id");

    new DataTable(`#${tableId}`, {
      pageLength: page ?? 10,
      ...translatorTable(),
      ...tableAjax(tableContainer),
    });
  });
};
