import { getComponent } from "./targets.js";

export function isActive(componentRef = "", state = false) {
  const component = getComponent(componentRef);

  component.setAttribute("skeleton", state);
}
