(function () {
  const popups = Array.from(document.querySelectorAll("[data-popup]"));

  popups.forEach((popup) =>
    popup.addEventListener("click", () => {
      const { popup: popupCurrent } = popup.dataset;

      popups.forEach((toggleElement) => {
        const { popup } = toggleElement.dataset;

        const element = document.querySelector(
          `[data-target-popup='${popup}']`
        );

        if (!element) return;

        if (popupCurrent === popup && !element.classList.contains("show")) {
          element.classList.add("show");
        } else {
          element.classList.remove("show");
        }
      });
    })
  );
})();
