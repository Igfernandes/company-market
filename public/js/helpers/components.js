import { COMPONENTS } from "../components/exports.js";

const loadedScripts = new Set();

export const managerComponents = async () => {
  for (const [refAttribute, componentPath] of Object.entries(COMPONENTS)) {
    const hasElement = document.querySelector(`[${refAttribute}]`);

    if (hasElement ) {
      try {
        const targetImport = await import(componentPath);
        if (targetImport.init) targetImport.init();

        // Marca como carregado
        loadedScripts.add(componentPath);
      } catch (err) {
        console.error(`Erro ao importar "${componentPath}":\n`, err);
      }
    }
  }
};

// Observa o DOM por novos elementos
const observer = new MutationObserver((mutation) => {
  mutation.forEach((mutationElement) => {
    if (mutationElement.target.getAttribute("id") === "render") {
      managerComponents();
    }
  });
});

observer.observe(document.body, {
  childList: true,
  subtree: true,
});
