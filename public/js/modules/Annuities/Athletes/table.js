import { RowClassification } from "./components/row.js";
import { locations } from "./locations.js";
import { Table as TableLib } from "../../../libs/Table/index.js";
import { getAnnuitiesService } from "../../../services/Annuities/Get.js";

export function Table() {
  this.initial = async (filters) => {
    const { data: annuities } = await getAnnuitiesService({
      atleta: true,
    });
    const { table } = locations;
    const rows = [];

    if (Array.isArray(annuities) && annuities.length > 0) {
      table.querySelector("tbody").innerHTML = "";

      annuities.forEach((annuitity) => {
        if (!annuitity.usuario) return;

        rows.push(
          RowClassification({
            id: annuitity.id,
            name: annuitity.usuario,
            registration: annuitity.matricula,
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
