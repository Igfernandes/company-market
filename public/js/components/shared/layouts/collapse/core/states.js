import { CollapseModule } from "../exports.js";

export function handleToggle(ev) {
  const header = ev.currentTarget;
  const collapseRef = header.getAttribute("collapse-target");
  const container = header.closest("[component='collapse']");
  const headersOld = CollapseModule.getHeaders(container);

  headersOld.forEach((header) => {
    if (header.getAttribute("collapse-target") === collapseRef)
      header.classList.add("active");
    else header.classList.remove("active");
  });
  if (header.classList.contains("active")) {
  }
}
