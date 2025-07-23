import { analysisFeedback, Log } from "./feedback.js";

/**
 * @param {string|undefined} component
 * @returns {void}
 */
export async function loadComponent(component) {
  if (!component) return alert("Error: Url do componente não definido");

  const url = new URL(window.location.href);
  url.searchParams.set("component", component);

  const initialTab = document.querySelector(`[data-component='${component}']`);
  initialTab.classList.add("is_active");
  
  window.history.pushState("update current component", "Query Component", url);

  const resp = await fetch(`/laboratory/${component}`);
  const html = await resp.text();

  document.querySelector("#render").innerHTML = html;

  const testsModule = await import(
    `../${component.toLowerCase()}/index.test.js`
  );

  const testSelect = document.querySelector("[name='test']");
  testSelect.innerHTML = "";

  /** Remover o primeiro índice */
  const option = document.createElement("option");
  option.innerHTML = "Selecione o teste";
  option.value = "";

  testSelect.appendChild(option);

  Object.entries(testsModule.TESTS).forEach(([name]) => {
    const option = document.createElement("option");
    option.innerHTML = name;

    testSelect.appendChild(option);
  });
}

export async function checkLoadComponents() {
  const components = document.querySelectorAll("[data-navbar='component']");
  let hasError = false;

  const handleError = (component) => {
    hasError = true;
    Log("ERROR", {
      component,
      message: "Não foi possível carregar o componente",
    });
  };

  for await (const component of components) {
    try {
      const { component: url } = component.dataset;

      const resp = await fetch(`/laboratory/${url}`);

      if (resp.status === 404) {
        handleError(component.textContent);
      }
    } catch (err) {
      handleError(component.textContent);
    }
  }

  analysisFeedback(hasError ? "ERROR" : "SUCCESS");
}
