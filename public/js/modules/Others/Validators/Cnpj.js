import { LoadFormGroup } from "../../../components/LoadFormGroup.js";
import { Snackbar } from "../../../components/snackbar/index.js";
import { searchCNPj } from "../../../helpers/searchs/searchCNPJ.js";
import { postValidatorsCnpj } from "../../../services/Validators/postCnpj.js";

export function Cnpj() {
  this.handle = async (ev) => {
    const element = ev.currentTarget;
    const { cnpjTarget, cnpjAutoComplete, cnpjDuply, cnpjException } =
      element.dataset;
    const snackbar = new Snackbar();
    const CNPJ_CURRENT = element.value;

    if (CNPJ_CURRENT.length != 18) return false;
    if (!CNPJ_CURRENT)
      return console.log(
        "Aviso: O CNPJ encontra-se incompleto ou incorreto para ser validado completamente"
      );

    if (cnpjException == CNPJ_CURRENT) return;

    if (cnpjDuply) {
      const { data: isCnpjAvaliable } = await postValidatorsCnpj({
        cnpj: CNPJ_CURRENT,
      });

      if (!isCnpjAvaliable)
        return snackbar.show(
          "failed",
          `O cnpj '${CNPJ_CURRENT}' encontra-se já registrado no sistema.`
        );
    }

    const load = LoadFormGroup(element);
    const { message, result: data } = await searchCNPj(CNPJ_CURRENT);

    if (message && message.includes("Token Inválido")) return load.remove();

    if (!data) {
      snackbar.show(
        "failed",
        `O cnpj '${CNPJ_CURRENT}' inserido não foi encontrado no sistema`
      );

      element.value = "";
      throw new Error("Ocorreu um problema com a API. error_cnpj");
    }

    load.remove();
    if (!cnpjTarget) return true;

    cnpjTarget.split("/").map((field) => {
      const fieldElement = document.querySelector(`[name='${field}']`);

      if (fieldElement)
        return console.log(
          `Não foi possível encontrar o campo ${field} no formulário. error_cnpj`
        );

      if (!cnpjAutoComplete) return fieldElement.removeAttribute("readonly");
      if (
        (fieldElement.dataset.cnpjField &&
          !data[fieldElement.dataset.cnpjField]) ||
        !data[field]
      )
        return console.log(
          `Não foi possível encontrar a propriedade. error_cnpj`
        );

      fieldElement.value = data[fieldElement.dataset.cnpjField] ?? data[field];
    });
  };
}
