import { LoadFormGroup } from "../../../components/LoadFormGroup.js";
import { searchCPF } from "../../../helpers/searchs/searchCPF.js";
import { Snackbar } from "../../../components/snackbar/index.js";

export function Cpf() {
  this.handle = async (ev) => {
    const element = document.querySelector(
      `[name="${ev.currentTarget.dataset.cpf}"]`
    );
    const snackbar = new Snackbar();
    const { cpfTarget, autoComplete, cpfReforce, targetBirthdate } =
      element.dataset;
    const CURRENT_CPF = element.value;
    const FIELDS_TARGET = cpfTarget.split("/").map((field) => {
      const fieldReference = field.split(":");
      let nameField = field;
      let dataNameField = field;

      if (fieldReference.length > 1) {
        nameField = fieldReference[0];
        dataNameField = fieldReference[1];
      }
      return {
        selector: nameField,
        propsName: dataNameField,
      };
    });

    const birthdate = document.querySelector(`[name='${targetBirthdate}']`);

    const load = LoadFormGroup(element);

    const { result: data, message = "" } = await searchCPF(
      CURRENT_CPF,
      birthdate ? birthdate.value : "01/01/2000"
    );

    if (message.includes("Token Inválido")) return load.remove();

    if (!data && cpfTarget) {
      snackbar.show(
        "failed",
        `O cpf '${CURRENT_CPF}' não é válido, insira um valor correto.`
      );

      FIELDS_TARGET.map((fieldReference) => {
        const fieldTarget = document.querySelector(
          `[name='${fieldReference.selector}']`
        );
        if (!fieldTarget) return;

        fieldTarget.value = "";
        fieldTarget.removeAttribute("readonly", true);
      });

      load.remove();
      if (cpfReforce == "true") return (element.value = "");
    }

    if (autoComplete && cpfTarget) {
      FIELDS_TARGET.map((fieldReference) => {
        const fieldElement = document.querySelector(
          `[name='${fieldReference.selector}']`
        );

        if (!fieldElement)
          throw new Error(
            `Não foi possível encontrar o campo ${fieldReference.selector} no formulário. error_cpf`
          );

        if (!autoComplete) return fieldElement.setAttribute("readonly", false);
        if (
          (fieldElement.dataset.cpfField &&
            data[fieldElement.dataset.cpfField]) ||
          data[fieldReference.propsName]
        ) {
          fieldElement.setAttribute("readonly", true);
          return fieldElement.setValue(
            data[fieldElement.dataset.cpfField] ??
              data[fieldReference.propsName],
            ev.type
          );
        }

        return console.log(
          `error_cpf: Não foi possível encontrar a  ${fieldReference.propsName}.`
        );
      });
    }

    load.remove();
  };
}
