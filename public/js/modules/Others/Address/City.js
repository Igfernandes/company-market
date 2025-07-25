import { Ajax } from "../../../libs/Ajax/index.js";

export function City() {
  this.handle = async (city, { state: stateTarget, target }) => {
    const element = document.querySelector(`[name='${city}']`);
    const ajax = new Ajax();

    const { data: response } = await ajax.get(
      `${window.location.origin}/json/address/city/${stateTarget}/cidades.json`
    );

    if (!response) throw new Error("Não foi possível carregar as cidades");

    element.innerHTML = '<option value=""> Selecione </option>"';
    response.map((city) => {
      if (element.dataset.city == city) {
        element.innerHTML +=
          '<option value="' + city + '" selected>' + city + "</option>";
      } else {
        element.innerHTML +=
          '<option value="' + city + '">' + city + "</option>";
      }
    });

    if (target) $(`[name='${element.name}']`).val(target);
    $(`[name='${element.name}']`).select2();
  };
}
