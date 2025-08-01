import { errors as errorsMensagens } from "../../constants/errors.js";
import globals from "./functions.js";
import { getField, isFieldExecutable } from "./utils/fields.js";
import { messagesClean } from "./utils/messages.js";
import { availableRulesException, isAvailableRule } from "./utils/rules.js";

/**
 * Classe responsável pela validação de campos de um formulário com base em regras definidas.
 *
 * @class Validations
 * @param {HTMLFormElement} form - O formulário a ser validado.
 */
export function Validations(form) {
  this.form = form;

  /**
   * Inicializa os ouvintes de eventos `change` para os campos do formulário com base nas regras fornecidas.
   *
   * @function
   * @param {Object} rules - Objeto contendo as regras de validação.
   * @example
   * validations.instanceRules({
   *   email: { required: true, email: true }
   * });
   */
  this.instanceRules = (rules) => {
    Object.entries(rules).map(([selector, rule]) => {
      const fields = document.querySelectorAll(`[name="${selector}"]`);

      if (fields.length == 0)
        console.log("Não foi possível encontrar " + selector);

      fields.forEach((field) =>
        field.addEventListener("change", () =>
          this.validField([selector, rule])
        )
      );
    });
  };

  /**
   * Executa a validação de todos os campos de acordo com as regras.
   *
   * @function
   * @param {Object} rules - Objeto contendo as regras de validação.
   * @returns {Array<Object>} - Lista de erros encontrados. Cada item contém `name` e `errors`.
   * @example
   * const errors = validations.execute({
   *   email: { required: true },
   *   password: { minLength: 6 }
   * });
   */
  this.execute = async (rules) => {
    const errors = [];
    for await (const [selector, rule] of Object.entries(rules)) {
      const field = document.querySelector(`[name="${selector}"]`);

      if (!field) {
        console.log("Não foi possível encontrar " + selector);
        continue;
      }

      const errorMessages = await this.valid([selector, rule], form);

      if (Array.isArray(errorMessages) && errorMessages.length > 0)
        errors.push({
          name: selector,
          errors: errorMessages,
        });
    }
    return errors;
  };

  /**
   * Valida um campo individual com base nas regras fornecidas.
   *
   * @async
   * @function
   * @param {[string, Object]} rule - Par contendo o nome do campo e o objeto de regras.
   * @returns {Promise<Array<string>>} - Lista de mensagens de erro, se houver.
   * @throws {Error} - Se o formulário não for fornecido.
   * @example
   * await validations.valid(['email', { required: true }]);
   */
  this.valid = async (rule) => {
    if (!this.form) throw new Error(errorsMensagens.notFoundForm);

    /** Validate fields with rules */
    const [name, { value, ...rules }] = rule;
    const field = getField(this.form, { name, value, ref: rules.ref });

    if (!isFieldExecutable(field)) return;

    messagesClean(field);

    if (!availableRulesException(rules)) return;
    const errors = [];

    for await (const [ruleName, ruleValue] of Object.entries(rules)) {
      const exec = globals[ruleName];

      if (isAvailableRule(ruleName)) continue;

      if (!exec) {
        console.log(
          `error_${ruleLabel}:Não foi possível encontrar a validação de ${name}`
        );
        continue;
      }

      const response = await exec(ruleValue, field);

      if (!response) {
        field.classList.remove("is-invalid");
        field.classList.add("is-valid");
        continue;
      }

      errors.push(response);

      setTimeout(() => {
        field.classList.add("is-invalid");
        const messageElement = form.querySelector(`[data-invalid='${name}']`);

        if (messageElement) messageElement.textContent = response;
      }, 200);
    }

    return errors;
  };
}
