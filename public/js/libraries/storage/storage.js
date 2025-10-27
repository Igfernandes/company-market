/**
 * @developer fernandes(github: https://github.com/Igfernandes)
 *
 * Libary: Uma biblioteca criada para otimizar a comunicação com o localstorage, tornando dinâmico as requisições.
 * version: 1.0.0
 */

export default function Storage() {
  /**
   * @description   Irá verificar os dados e inserir dentro do localstorage. Caso não seja definido um "id", só colocar "id" como parâmetro que ele irá criar de forma dinâmica por número
   *
   * @param {string}    key O id/indice que voce quer buscar o valor no localstorage.
   */
  this.select = function (key) {
    try {
      return JSON.parse(sessionStorage.getItem(key));
    } catch (err) {
      throw new Error("Os dados não foram inseridos no localStorage");
    }
  };

  /**
   * @description   Irá salvar informações no localstorage.
   *
   * @param id    Guarda o identificador que estará no localstorage
   * @param id    Guarda os dados que serão amarzenados detro do localstorage.
   */
  this.save = function ($id, $dates) {
    try {
      sessionStorage.setItem($id, JSON.stringify($dates));
    } catch (err) {
      throw new Error("Os dados não foram inseridos no localStorage: " + err);
    }
  };
}
