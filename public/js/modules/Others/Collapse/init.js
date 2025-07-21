import { Collapse } from "./index.js";

export const init = () => {
  const collapses = new Collapse();

  $(`[data-collapse]`).on("select2:select", collapses.handle);
  $(`[data-collapse]`).on("change", collapses.handle);
};
