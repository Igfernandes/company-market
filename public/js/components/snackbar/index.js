import { snackbarType } from "../../constants/snackbar.js";

const TIME_CLOSE_MODAL = 4000;

export function Snackbar() {
  this.container = null;

  this.show = (type = "success", message, { timeToClose, title } = {}) => {
    if (document.querySelector(".snackbar")) return;

    const container = document.createElement("div");
    container.className = `snackbar`;
    const content = document.createElement("div");
    content.className = "cbtarco_modal";
    content.style = "max-width: 400px; height: 100%;margin-top: 5vw;";
    container.appendChild(content);
    const head = document.createElement("div");
    head.className = `cbtarco_modal-head ${snackbarType[type].background}`;
    content.appendChild(head);
    const body = document.createElement("div");
    body.className = "cbtarco_modal-body";
    content.appendChild(body);
    document.body.appendChild(container);

    //ELEMENTOS RESTANTES
    const button = document.createElement("button");
    button.textContent = "x";
    button.className = snackbarType[type].background;
    button.addEventListener("click", (ev) => {
      container.remove(ev);
    });

    const span = document.createElement("span");
    span.textContent = title ?? snackbarType[type].title;

    container.classList.add("modal-show");
    content.classList.add("cbtarco_modal-show");
    head.appendChild(span);
    head.appendChild(button);

    if (typeof message == "string") body.innerHTML = message;
    else {
      const ul = document.createElement("ul");
      ul.className = "p-0 m-0";
      let errors = message;

      if (typeof message == "object")
        errors = Object.entries(message).map(([label, value]) => value);

      errors.map((messageError) => {
        const li = document.createElement("li");
        li.innerHTML = messageError;

        ul.appendChild(li);
      });

      body.appendChild(ul);
    }

    this.container = container;

    setTimeout(() => {
      this.container.remove();
    }, timeToClose ?? TIME_CLOSE_MODAL);
  };
}
