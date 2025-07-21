import { Input } from "../../../../components/shared/forms/input.js";
import { Link } from "../../../../components/shared/utils/link.js";

export function RowClub({ id, name, cnpj, situation }) {
  const tr = document.createElement("tr");
  const cols = {};

  cols["name"] = document.createElement("td");
  cols["name"].classList = "p-2 dtr-control";
  cols["name"].textContent = name;
  cols["name"].appendChild(
    Input({
      name: "id",
      type: "hidden",
      value: id,
    })
  );

  cols["cnpj"] = document.createElement("td");
  cols["cnpj"].classList = "p-2 dtr-control";
  cols["cnpj"].textContent = cnpj;

  cols["situation"] = document.createElement("td");
  cols["situation"].classList = "p-2 dtr-control";
  cols["situation"].textContent = situation;

  cols["action"] = document.createElement("td");
  cols["action"].appendChild(
    Link({
      className: "btn btn-primary",
      text: "Detalhes",
      href: `/painel/financeiro/instituicoes/detalhes?id=${id}`,
    })
  );

  Object.entries(cols).forEach(([label, col]) => tr.appendChild(col));

  return tr;
}
