import { RowUsers } from "./components/row.js";
import { locations } from "./locations.js";
import { Table as TableLib } from "../../../libs/Table/index.js";
import { getUsers } from "../../../services/Users/get.js";
import { Navigation } from "../../../libs/Navigation/index.js";

export function Table() {
  this.initial = async (filters) => {
    const navigation = new Navigation();

    const { data: users } = await getUsers({
      groups: navigation.getParam("group"),
    });
    const { table } = locations;
    const rows = [];

    if (Array.isArray(users) && users.length > 0) {
      table.querySelector("tbody").innerHTML = "";

      users.forEach((user) => {
        if (!user.name) return;

        const fieldsAmountFilled = user.fields;

        rows.push(
          RowUsers({
            id: user.id,
            name: user.name,
            cpf: user.cpf,
            registration: user.registration,
            status: user.status,
            fill: (fieldsAmountFilled.filled / fieldsAmountFilled.total) * 100  ,
            createdAt: user.created_at
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
