import { Input } from "../shared/forms/input.js";
import { RowFilter } from "./row.js";

export function SearchBar() {
  this.create = (filtersContent, { table }) => {
    /*Criando a linha onde adcionaremos o search*/
    const rowFilter = new RowFilter();
    let row = rowFilter.create(filtersContent);

    filtersContent.insertBefore(row, filtersContent.childNodes[1]);

    /*Criando e adicionando content do input e o input*/
    const div = document.createElement("div");
    div.classList = "d-flex m-2";
    div.setAttribute("data-filter", "search");

    const label = document.createElement("label");
    label.style =
      "font-weight: normal; display: flex; width: 100%; align-items: center; margin-bottom:0px;";
    label.id = "search";

    /*Criando e adicionando o select*/
    const select = document.createElement("select");
    select.classList = "mb-0 mx-1";
    const optionDefault = document.createElement("option");
    optionDefault.value = "";
    optionDefault.innerText = "Todas";
    select.appendChild(optionDefault);

    /*Criando e adicionando options do select*/
    const columnsHeadTable = table.querySelectorAll("thead th");
    columnsHeadTable.forEach((columnHead, key) => {
      const option = document.createElement("option");
      option.value = key;
      option.innerText = columnHead.textContent;
      select.appendChild(option);
    });

    row.appendChild(div);
    div.appendChild(label);
    label.appendChild(select);
    const input = Input({
      placeholder: "Faça uma pesquisa",
      className: "ml-2 form-control form-control-sm search-bar",
      type: "search",
    });
    label.appendChild(input);

    return {
      input,
      select,
    };
  };
}
