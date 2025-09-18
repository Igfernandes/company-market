import { tableInstance } from "../settings/instance.js";

export function handleCheckedAll() {
  const btnSelectedAll = Array.from(
    document.querySelectorAll("[checked-settings='all']")
  );

  btnSelectedAll.forEach((btnSelected) => {
    btnSelected.addEventListener("click", () => {
      const tableId = btnSelected.getAttribute("target-table");
      const table = window.tables[tableId];
      if (!table) return;

      // Descobre se todas as linhas estão selecionadas
      const allSelected = table
        .rows()
        .data()
        .toArray()
        .every((row) => row._selected);

      // Inverte o estado
      const isCheckedAll = !allSelected;

      // Atualiza o texto do botão
      btnSelected.textContent = isCheckedAll
        ? "Desmarcar todos"
        : "Selecionar todos";

      // Marca/desmarca todas as linhas
      table.rows().every(function () {
        const rowData = this.data();
        rowData._selected = isCheckedAll; // guarda o estado no dado
        this.data(rowData); // atualiza a linha
      });

      // Re-renderiza a tabela atual
      table.draw(false);
    });
  });
}

export function handleChecked(ev) {
  const input = ev.currentTarget;
  const tableComponent = input.closest("[component='table']");
  const tableId = tableComponent.getAttribute("id");

  const table = window.tables[tableId];
  if (!table) return;

  table.rows({ page: "current" }).every(function () {
    const rowData = this.data();

    if (rowData.map((data) => String(data)).includes(input.value)) {
      rowData._selected = input.checked;
      this.data(rowData); // atualiza o dado da linha
      this.invalidate();
    }
  });

  table.draw(true); // redesenha mas mantém a paginação
}

export async function handleReloadTable(tableId) {
  if (!tableId)
    return console.warn(`Não foi possível encontrar a tabela ${tableId}`);

  const oldTable = window.tables[tableId];

  if (oldTable) {
    await oldTable.destroy();
    delete window.tables[tableId];
  }

  const tableContainer = document.querySelector(`#${tableId}`);
  tableInstance(tableContainer);
}

export function getCheckedRows(tableId) {
  const table = window.tables[tableId];

  return table
    .rows()
    .data()
    .toArray()
    .filter((row) => !!row._selected);
}
