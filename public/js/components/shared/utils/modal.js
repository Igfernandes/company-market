export const init = () => {
  const closeBtn = document.querySelectorAll(
    "[data-component='modal:close']"
  );

  closeBtn.forEach((closeBtnElement) => {
    closeBtnElement.addEventListener("click", () => {
      closeBtnElement.closest("[component='modal']").remove();
    });
  });
};
