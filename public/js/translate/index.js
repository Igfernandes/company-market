import { translates } from "./languages/pt-br/index.js";

/**
 * Traduz uma chave no formato "API.users.invalid.password" acessando
 * propriedades aninhadas dentro do objeto `translates`.
 *
 * @param {string} string - A chave da tradução no formato de caminho com pontos (e.g., "API.users.invalid.password").
 * @returns {string|undefined} O valor traduzido correspondente à chave, ou `undefined` se não for encontrado.
 */
export function translate(path) {
  if (!path) return;
  const proprietiesList = path.split(".");

  return proprietiesList.reduce((acc, key) => {
    return acc && acc[key] !== undefined ? acc[key] : undefined;
  }, translates);
}
