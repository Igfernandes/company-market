import { Component, ComponentManager } from "../../../helpers/components.js";

const TIME_CLOSE_MODAL = 4000;

export function Snackbar() {
  /**
   *
   * @param {"SUCCESS"|"FAIL"|"NOTICE"} type
   * @param {{
   *   title: string,
   *   message: string,
   *   timeToClose: integer
   * }} options
   */
  this.execute = async (
    type = "SUCCESS",
    { message, timeToClose, title } = {}
  ) => {
    this.clean();
    const snackbarContent = await Component("/utils/snackbar", {
      title,
      message,
      type: type.toUpperCase(),
    });

    document.body.appendChild(snackbarContent);
    new ComponentManager().single("component='snackbar'");

    setTimeout(() => {
      snackbarContent.remove();
    }, timeToClose ?? TIME_CLOSE_MODAL);

    return {
      modal: snackbarContent,
    };
  };

  this.clean = () => {
    document
      .querySelectorAll("[component='snackbar']")
      .forEach((component) => component.remove());
  };
}

export const snackbar = new Snackbar();

export const init = () => {
  const closeBtn = document.querySelectorAll("[component='snackbar:close']");

  closeBtn.forEach((closeBtnElement) => {
    closeBtnElement.addEventListener("click", () => {
      closeBtnElement.closest("[component='snackbar']").remove();
    });
  });

  const snackbarList = Array.from(
    document.querySelectorAll("[component='snackbar']")
  );

  snackbarList.forEach(() => {
    setTimeout(() => {
      snackbar.clean();
    }, 4000);
  });
};
