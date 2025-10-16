import { EyeCloseIcon } from "../../../../assets/icons/EyeCloseIcon.js";
import { EyeOpenIcon } from "../../../../assets/icons/EyeOpenIcon.js";

export const init = () => {
  const elementsPassword = document.querySelectorAll(
    "[password-visibility]"
  );

  const handleToggleTypePassword = (eyeContent) => {
    const container = eyeContent.closest("[password='visibility']");
    const input = container.querySelector("[name]");
    const refAttribute = "password-visibility";

    const handleOpenEye = () => {
      eyeContent.setAttribute(refAttribute, "OPEN");
      input.type = "text";
      eyeContent.innerHTML = EyeOpenIcon();
    };
    const handleCloseEye = () => {
      eyeContent.setAttribute(refAttribute, "CLOSE");
      input.type = "password";
      eyeContent.innerHTML = EyeCloseIcon();
    };

    switch (eyeContent.getAttribute(refAttribute)) {
      case "OPEN":
        handleCloseEye();
        break;
      case "CLOSE":
        handleOpenEye();
        break;
      default:
        handleCloseEye();
        break;
    }
  };

  elementsPassword.forEach(function (element) {
    element.addEventListener("click", () => {
      handleToggleTypePassword(element);
    });
    handleToggleTypePassword(element);
  });
};
