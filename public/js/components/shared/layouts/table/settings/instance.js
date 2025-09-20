import { SkeletonModules } from "../../../utils/skeleton/exports.js";
import { tableAjax } from "./ajax.js";
import { tableRender } from "./render.js";
import { translatorTable } from "./translator.js";

export async function tableInstance(tableContainer) {
  const table = tableContainer.querySelector("table");
  const { page } = table.dataset;
  SkeletonModules.isActive(tableContainer.getAttribute("component"), true);

  window.tables = window.tables ?? {};
  const tableId = table.getAttribute("id");

  const instance = new DataTable(`#${tableId}`, {
    pageLength: page ?? 10,
    ...translatorTable(),
    ...tableAjax(tableContainer),
    ...tableRender(tableContainer),
    info: false,
    responsive: true,
    select: {
      style: "multi", // pode ser 'single', 'multi', 'os'
    },
    pagingType: "simple_numbers",
  });

  window.tables[tableContainer.getAttribute("id")] = instance;
  SkeletonModules.isActive(tableContainer.getAttribute("component"), false);
  
  instance.on("draw", function () {
    instance.rows().every(function () {
      const rowNode = this.node();
      const rowData = this.data();

      if (!rowNode || !rowData._selected) return;

      const checkbox = rowNode.querySelector("input");
      if (checkbox) checkbox.checked = !!rowData._selected;
    });
  });
}
