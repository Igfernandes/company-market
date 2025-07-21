export function Collapse() {
  this.handle = (ev) => {
    const field = ev.currentTarget;
    const targetCollapse = field.dataset.collapseTarget;

    if (!targetCollapse) {
      const valueCollapse = field.dataset.collapseValue;
      const boxCollapse = document.querySelector(
        `[data-collapse-content="${field.dataset.collapse}"]`
      );

      if (field.value == valueCollapse) {
        $(boxCollapse).collapse("show");
      } else {
        $(boxCollapse).collapse("hide");
      }
    } else {
      const listCollapses = targetCollapse.split("/");
      listCollapses.forEach((collpaseReferences) => {
        const references = collpaseReferences.split(":");
        const boxCollapse = document.querySelector(
          `[data-collapse-content="${references[1]}"]`
        );
        if (field.value == references[0]) {
          setTimeout(() => {
            $(boxCollapse).collapse("show");
          }, 500);
        } else {
          $(boxCollapse).collapse("hide");
        }
      });
    }
  };
}
