import { mapData } from "./array.js";

export function buildCallbackProps(table, pageData) {
  const callbackProps = { data: pageData };
  const container = table.closest("[component='table']");

  if (!table.querySelector("thead")) {
    const sample = pageData[0];
    if (sample) {
      const columns = Object.keys(sample).map((key) => ({
        data: key,
        title: key,
        name: key,
      }));
      callbackProps["columns"] = columns;
    }
  } else {
    const references =
      container.getAttribute("table-relations")?.split(",") ?? [];

    callbackProps["data"] = mapData(pageData, references);
  }

  return callbackProps;
}
