import { Input } from "../../../../../components/shared/forms/input.js";
import { Link } from "../../../../../components/shared/utils/link.js";

export function RowCustomForms({ id, page, status, created_at, updated_at }) {
  const tr = document.createElement("tr");
  const cols = {};

  cols["page"] = document.createElement("td");
  cols["page"].classList = "p-2 dtr-control";
  cols["page"].textContent = page;
  cols["page"].appendChild(
    Input({
      name: "id",
      type: "hidden",
      value: id,
    })
  );

  const STATUS_TYPE = {
    PUBLISHED: "PUBLICADO",
    DRAFT: "RASCUNHO",
  };

  cols["status"] = document.createElement("td");
  cols["status"].classList = "p-2 dtr-control";
  cols["status"].textContent = STATUS_TYPE[status];

  cols["created_at"] = document.createElement("td");
  cols["created_at"].classList = "p-2 dtr-control";
  cols["created_at"].textContent = created_at;

  cols["updated_at"] = document.createElement("td");
  cols["updated_at"].classList = "p-2 dtr-control";
  cols["updated_at"].textContent = updated_at;

  cols["action"] = document.createElement("td");
  cols["action"].appendChild(
    Link({
      className: "btn btn-primary w-100",
      text: "Editar",
      href: `/panel/configurations/customized/form?customized=${id}`,
    })
  );

  Object.entries(cols).forEach(([label, col]) => tr.appendChild(col));

  return tr;
}
