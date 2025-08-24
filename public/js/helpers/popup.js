(function () {
  const popups = Array.from(document.querySelectorAll("[popup]"));

  popups.forEach((popup) =>
    popup.addEventListener("click", () => {
      const popupCurrent = popup.getAttribute("popup");

      popups.forEach((toggleElement) => {
        const popup = toggleElement.getAttribute("popup");
        const element = document.querySelector(`[target-popup='${popup}']`);

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
