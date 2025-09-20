export function getComponent(targetComponent) {
  return typeof targetComponent == "string"
    ? document.querySelector(`[component='${targetComponent}']`)
    : targetComponent;
}
