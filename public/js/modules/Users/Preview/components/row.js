import { Input } from "../../../../components/shared/forms/input.js";
import { Link } from "../../../../components/shared/utils/link.js";
import { formatteDateBr } from "../../../../helpers/formatteDateBr.js";

export function RowUsers({ id, name, cpf, registration, status, fill, createdAt }) {
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

  cols["cpf"] = document.createElement("td");
  cols["cpf"].classList = "p-2 dtr-control";
  cols["cpf"].textContent = cpf;

  cols["status"] = document.createElement("td");
  cols["status"].classList = "p-2 dtr-control";
  cols["status"].textContent = status;

  cols["fill"] = document.createElement("td");
  cols["fill"].classList = "p-2 dtr-control text-center";
  cols["fill"].textContent = `${fill}%`;

  cols["createdAt"] = document.createElement("td");
  cols["createdAt"].classList = "p-2 dtr-control";
  cols["createdAt"].textContent =  formatteDateBr(createdAt);

  cols["action"] = document.createElement("td");
  cols["action"].appendChild(
    Link({
      className: "btn btn-primary w-100",
      text: "Editar",
      href: `/panel/users/forms?user=${id}`,
    })
  );

  Object.entries(cols).forEach(([label, col]) => tr.appendChild(col));

  return tr;
}
