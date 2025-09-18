export const init = () => {
  const label = document.querySelectorAll("[data-label-toggle]");
  
  label.forEach(function (labelElement) {
    const container = labelElement.closest("div");
    const input = container.querySelector("[name]");

    labelElement.setAttribute("data-label-toggle", !!input.value);

    input.addEventListener("keyup", function (event) {
      const value = event.currentTarget.value;

      labelElement.setAttribute("data-label-toggle", !!value);
    });
  });
};
