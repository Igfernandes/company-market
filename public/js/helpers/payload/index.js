import { splitByBrackets } from "../string.js";
import { setDeepValue } from "./control.js";

export function formDataToJson(formData) {
  const jsonObject = {};

  for (const [key, value] of formData.entries()) {
    const parts = splitByBrackets(key);

    if (parts.length > 1) {
      setDeepValue(jsonObject, parts, value);
    } else {
      jsonObject[key] = value;
    }
  }

  return jsonObject;
}
