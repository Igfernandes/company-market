/**
 * @param {"SUCCESS"|"ERROR"} type
 * @param {{
 *    component: string,
 *    message: string
 * }} message
 */
export function Log(type, { component = "", message = "" }) {
  const p = document.createElement("p");
  const now = new Date(Date.now());

  p.classList.add(type == "ERROR" ? "text-danger" : "text-success");
  p.innerHTML = `<strong>[${component} - <span class='text-xs'>${now.getHours()}:${now.getMinutes()}</span>]</strong>: `;

  const span = document.createElement("span");
  span.innerHTML = message;
  span.className = "text-xs text-white";
  p.appendChild(span);

  document.querySelector("[data-log]").appendChild(p);
}

export function analysisFeedback(type) {
  const statusBar = document.querySelector("[data-action='status-bar']");

  if (!statusBar)
    return console.warn(
      "(status-bar): Ocorreu um erro ao encontrar o elemento responsável pelo status de carregamento dos componentes"
    );

  switch (type) {
    case "ERROR":
      statusBar.classList.remove("bg-orange-400");
      statusBar.classList.add("bg-red-400");
      statusBar.classList.add("text-white");
      statusBar.innerHTML = "Falha ao carregar componentes";
      break;
    case "SUCCESS":
      statusBar.classList.remove("bg-orange-400");
      statusBar.classList.add("bg-green-400");
      statusBar.classList.add("text-white");
      statusBar.innerHTML = "Componentes Carregados";
      break;
  }
}
