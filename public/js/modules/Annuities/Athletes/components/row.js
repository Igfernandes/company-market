import { Input } from "../../../../components/shared/forms/input.js";
import { Link } from "../../../../components/shared/utils/link.js";

export function RowClassification({ id, name, registration, situation }) {
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

  cols["registration"] = document.createElement("td");
  cols["registration"].classList = "p-2 dtr-control";
  cols["registration"].textContent = registration;

  cols["situation"] = document.createElement("td");
  cols["situation"].classList = "p-2 dtr-control";
  cols["situation"].textContent = situation;

  cols["action"] = document.createElement("td");
  cols["action"].appendChild(
    Link({
      className: "btn btn-primary",
      text: "Detalhes",
      href: `/painel/financeiro/afiliados/detalhes?id=${id}`,
    })
  );

  Object.entries(cols).forEach(([label, col]) => tr.appendChild(col));

  return tr;
}
