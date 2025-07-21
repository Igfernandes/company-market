import { Trash } from "../assets/trash.js";

export function deleteElment(btnReference) {
  const elementToDelete = btnReference.dataset.targetDelete;
  const btnDeleteContent = document.createElement("div");

  if (btnDeleteContent.querySelector(".btn.btn-danger.float-right")) return;

  const btnDelete = document.createElement("a");
  btnDelete.innerHTML = Trash();
  btnDelete.className = "btn btn-danger float-right";
  btnDelete.style = "width: 3rem";

  btnDeleteContent.appendChild(btnDelete);
  btnReference.appendChild(btnDeleteContent);

  btnDelete.addEventListener("click", () => {
    const element = btnReference.closest(elementToDelete);

    if (element) element.remove();
  });

  return btnDelete;
}

export const init = () => {
  const contentsOfDelete = document.querySelectorAll("[data-delete]");

  contentsOfDelete.forEach((content) => deleteElment(content));
};
