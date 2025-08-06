import "../../../../libraries/DataTables/dataTables.js";
import { tableAjax } from "./settings/ajax.js";
import { tableRender } from "./settings/render.js";
import { translatorTable } from "./settings/translator.js";

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
      ...tableRender(tableContainer),
      info: false,
      pagingType: "simple_numbers",
    });
  });
};
