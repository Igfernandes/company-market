/**
 * Cria um observador para detectar mudanças em um elemento HTML utilizando MutationObserver.
 *
 * @function useObserver
 * @param {HTMLElement} element - O elemento HTML que será observado.
 * @param {function(MutationRecord): void} callback - Função executada a cada mutação detectada.
 * @param {Object} [options] - Configurações adicionais para o observer.
 * @param {boolean} [options.childList=true] - Observa adição/remoção de elementos filhos.
 * @param {boolean} [options.attributes=true] - Observa alterações de atributos.
 * @param {boolean} [options.characterData=true] - Observa mudanças no conteúdo de texto.
 * @param {boolean} [options.subtree=true] - Observa também os descendentes do elemento.
 * @returns {MutationObserver} O objeto MutationObserver, permitindo desconectar posteriormente.
 *
 * @example
 * // Exemplo de uso:
 * const target = document.getElementById("meuElemento");
 *
 * const observer = useObserver(target, (mutation) => {
 *   console.log("Mudança detectada:", mutation);
 * });
 *
 * // Para parar de observar:
 * observer.disconnect();
 */
export function Observer(element, callback, options = {}) {
  if (!element) {
    console.error("Elemento não informado para o observer.");
    return;
  }

  const defaultOptions = {
    childList: true,
    attributes: true,
    characterData: true,
    subtree: true,
  };

  const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
      callback(mutation);
    });
  });

  observer.observe(element, { ...defaultOptions, ...options });

  return observer;
}
