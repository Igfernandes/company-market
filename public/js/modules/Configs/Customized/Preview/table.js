import { RowCustomForms } from "./components/row.js";
import { locations } from "./locations.js";
import { Table as TableLib } from "../../../../libs/Table/index.js";
import { formatteDateBr } from "../../../../helpers/formatteDateBr.js";
import { getCustomForms } from "../../../../services/CustomForms/get.js";

export function Table() {
  this.initial = async (filters) => {
    const { data: customForms } = await getCustomForms();
    const { table } = locations;
    const rows = [];

    if (Array.isArray(customForms) && customForms.length > 0) {
      table.querySelector("tbody").innerHTML = "";

      customForms.forEach((event) => {
        if (!event.page) return;

        rows.push(
          RowCustomForms({
            id: event.id,
            page: event.page,
            components: event.components ?? [],
            status: event.status,
            created_at: formatteDateBr(event.created_at),
            updated_at: formatteDateBr(event.updated_at),
          })
        );
      });
    }

    new TableLib({
      table,
      rows,
      filters,
      pagePreview: 8,
      filtersRef: {
        timeRef: [2, 3],
      },
    }).handle();
  };
}
