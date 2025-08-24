import { COMPONENTS } from "../components/require.js";
import { COMPONENTS_PATH } from "../constants/components.js";
import { getQueryParams } from "./route.js";

const loadedScripts = new Set();

/**
 * @function
 * @param {string} path O caminho relativo do componente referente a sua rota.
 * @param {Object} props  As propriedades que alimentaram o componente.
 *
 * @return {string} component
 */
export async function Component(path = "", props = {}) {
  const queries = getQueryParams(props);
  const pathFiltered = COMPONENTS_PATH[path] ?? path;

  const stringOnlySingleBar =
    `/load/component/${pathFiltered}?${queries}`.replaceAll("//", "/");

  const component = await (await fetch(stringOnlySingleBar)).text();
  const componentParts = component.split("<!-- DEBUG-VIEW ENDED");
  const container = document.createElement("div");
  container.innerHTML = componentParts[0] ?? component;
  
  return container.firstElementChild;
}

export function ComponentManager() {
  this.loadComponent = async (refAttribute, componentPath) => {
    const hasElement = document.querySelector(`[${refAttribute}]`);

    if (!hasElement) return;

    try {
      const targetImport = await import(componentPath);
      if (targetImport.init) targetImport.init();

      // Marca como carregado
      loadedScripts.add(componentPath);
    } catch (err) {
      console.error(`Erro ao importar "${componentPath}":\n`, err);
    }
  };

  this.single = async (selector) => {
    await this.loadComponent(selector, COMPONENTS[selector]);
  };

  this.init = async () => {
    for await (const [refAttribute, componentPath] of Object.entries(
      COMPONENTS
    )) {
      await this.loadComponent(refAttribute, componentPath);
    }
  };
}

// Observa o DOM por novos elementos
const observer = new MutationObserver((mutation) => {
  mutation.forEach(async (mutationElement) => {
    const hasAvailableComponentUpdates =
      mutationElement.target.getAttribute("id") === "render";

    if (hasAvailableComponentUpdates) {
      await new ComponentManager().init();
    }
  });
});

observer.observe(document.body, {
  childList: true,
  subtree: true,
});
