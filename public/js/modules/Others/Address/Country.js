import { Ajax } from "../../../libs/Ajax/index.js";

export function Country() {
  this.handle = async (ev) => {
    const element = ev.currentTarget ?? ev;
    const ajax = new Ajax();
    let paises = "";

    const { data: response } = await ajax.get(`${window.location.origin}/json/address/country.json`);

    if (!response) throw new Error("Não foi possível carregar os países");

    response.map(({ Pais, Sigla }) => {
      if (Pais == "Brasil") {
        paises +=
          '<option value="' + Sigla + '" selected>' + Pais + "</option>";
      } else {
        paises += '<option value="' + Sigla + '">' + Pais + "</option>";
      }
    });

    $(`[name='${element.name}']`).html(paises);
  };
}
