import { RowClub } from "./components/row.js";
import { locations } from "./locations.js";
import { Table as TableLib } from "../../../libs/Table/index.js";
import { getAnnuitiesService } from "../../../services/Annuities/Get.js";

export function Table() {
  this.initial = async (filters) => {
    const { data: annuities } = await getAnnuitiesService({
      clube: true
    });
    const { table } = locations;
    const rows = [];

    if (Array.isArray(annuities) && annuities.length > 0) {
      table.querySelector("tbody").innerHTML = "";

      annuities.forEach((annuitity) => {
        if (!annuitity.institucional) return;
        
        rows.push(
          RowClub({
            id: annuitity.id,
            name: annuitity.institucional,
            cnpj: annuitity.cnpj,
            situation: annuitity.status,
          })
        );
      });
    }

    new TableLib({
      table,
      rows,
      filters,
      pagePreview: 8,
    }).handle();
  };
}
