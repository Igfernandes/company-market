import { LoadFormGroup } from "../../../components/LoadFormGroup.js";
import { Snackbar } from "../../../components/snackbar/index.js";
import { searchCEP } from "../../../helpers/searchs/searchCEP.js";
import { City } from "../Address/City.js";

export function Cep() {
  this.handle = async (ev) => {
    const element = ev.currentTarget;
    const {
      cepTarget = "estado/cidade/bairro/logadouro/numero/complemento",
      autoComplete,
      cepEnableFields,
    } = element.dataset;
    const snackbar = new Snackbar();
    const cep = element.value.match(/\d+/g).join("");
    const city = new City();

    if (cep.toString().length < 8) return false;
    if (!cep)
      return console.log(
        "Aviso: O CEP encontra-se incompleto ou incorreto para ser validado completamente"
      );

    const load = LoadFormGroup(element);
    const data = await searchCEP(cep);

    load.remove();

    if (!data) {
      snackbar.show(
        "failed",
        `O cep '${cep}' inserido não foi encontrado no sistema`
      );

      cepTarget.split("/").map((field) => {
        const element = document.querySelector(`[name='${field}']`);

        if (element) element.setAttribute("disabled", false);
      });
      throw new Error("Ocorreu um problema com a API. error_cep");
    }

    if (!cepTarget) return true;

    cepTarget.split("/").forEach(async (field) => {
      const referenceField = field.split(":");
      let label = field;

      if (referenceField.length > 1) {
        label = referenceField[1];
        field = referenceField[0];
      }

      const fieldElement = document.querySelector(`[name='${field}']`);

      if (!autoComplete || cepEnableFields) fieldElement.disabled = false;
      if (!fieldElement)
        throw new Error(
          `Não foi possível encontrar o campo ${field} no formulário. error_cep`
        );
      if (
        (fieldElement.dataset.cepField &&
          data[fieldElement.dataset.cepField]) ||
        data[label]
      )
        if (fieldElement.tagName == "INPUT")
          return (fieldElement.value =
            data[fieldElement.dataset.cepField] ?? data[label]);
        else {
          $(`[name='${field}']`).val(
            data[fieldElement.dataset.cepField] ?? data[label]
          );
          fieldElement.value =
            data[fieldElement.dataset.cepField] ?? data[label];

          if (fieldElement.dataset.cityTarget) {
            await city.handle(fieldElement.dataset.cityTarget, {
              state: fieldElement.value,
              target: data["localidade"],
            });
          }
          return $(`[name='${field}']`).select2();
        }

      return console.log(
        `Não foi possível encontrar a propriedade ${field}. error_cep`
      );
    });
  };
}
