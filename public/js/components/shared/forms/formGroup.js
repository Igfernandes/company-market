import { Div } from "../utils/div";
import { Input } from "./input";
import { Label } from "./label";

export function FormGroup({
  name = "",
  labelText = "",
  value = "",
  id = "",
  attributes = [],
}) {
  const div = Div({
    className: "form-group",
  });
  const label = Label({
    text: labelText,
    for: id,
  });
  const input = Input({
    name,
    attributes,
    value,
  });

  div.appendChild(label);
  div.appendChild(input);

  return div;
}
