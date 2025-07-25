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
   * @param {object}    declare um objeto do mesmo nome e valor com o id/indice que voce quer buscar o valor no localstorage.
   * @param {object}        Se voce colocar o valor como "id", ele irá criar índices numéricos dinâmicos.
   */
  this.select = function ({ id, ...params }) {
    for (const param of params) {
      const data = localStorage.getItem(param);

      if (id) {
        if (data == null) {
          localStorage.setItem("id", 1); // Caso não haja nenhum índice numérico do padrão "id" ele cria o primeiro
          return 1;
        } else {
          let status = parseInt(data) + 1; // Caso já haja um indíce numérico e o valor seja encontrado ele cria um próximo indíce, passando a localização do ultimo elemento "id" para voce gerar o próximo elemento.
          localStorage.setItem("id", status);
          return status;
        }
      } else {
        return data ? data : false;
      }
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
      localStorage.setItem($id, JSON.stringify($dates));
    } catch (err) {
      throw new Error("Os dados não foram inseridos no localStorage");
    }
  };

  /**
   * @description   Irá apagar informações no localstorage.
   *
   * @param $act    É um objeto que guarda os seguintes parâmetros:
   * @param key      É o identificador do campo que deseja excluir
   * @param action   É o parâmetro especial para deletar todos elementos com 'id' to tipo número. Passe o valor "all" ou não declare.
   */
  this.delete = function ($act) {
    if ($act.key) {
      if (!$act.action) {
        localStorage.removeItem($act.key);
      } else if ($act.key == "all") {
        let val = localStorage.getItem("id");

        for (let r = 1; r <= val; r++) {
          localStorage.removeItem(r);
        }
      }
    }
  };

  this.toConvert = function ($obj) {
    /**
     * @description   Irá transformar array em objeto. Além de capturar no localstorage o valor do campo,
     * ainda converte objetos em array e retorna os valores.
     *
     * @param { string } id   Guarda o identificador que estará no localstorage
     * @param { object } dates  Guarda os dados que serão amarzenados detro do localstorage
     */

    let list = new Array();

    let id = this.select($obj);
    for (let x = 1; x <= id; x++) {
      let bloco = JSON.parse(this.select({ fields: x }));

      if (bloco === null) {
        continue;
      }
      bloco["id"] = x;

      list.push(bloco);
    }

    return list;
  };
}
