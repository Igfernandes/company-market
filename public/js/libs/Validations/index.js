import { errors as errorsMensagens } from "../../constants/errors.js";
import exceptions from "./exception.js";
import globals from "./functions.js";

export function Validations() {
  this.instanceRules = (rules, form) => {
    Object.entries(rules).map(([selector, rule]) => {
      const fields = document.querySelectorAll(`[name="${selector}"]`);

      if (fields.length == 0)
        console.log("Não foi possível encontrar " + selector);

      fields.forEach((field) =>
        field.addEventListener("change", () =>
          this.validField([selector, rule], form)
        )
      );
    });
  };

  this.executeRules = (rules, form) => {
    Object.entries(rules).map(([selector, rule]) => {
      const field = document.querySelector(`[name="${selector}"]`);

      if (!field) console.log("Não foi possível encontrar " + selector);

      this.validField([selector, rule], form);
    });
  };

  this.init = async (fields = {}, form = "form") => {
    const errors = [];
    const formElement = document.querySelector(form);

    if (!formElement) throw new Error(errorsMensagens.notFoundForm);

    /** Remove Temporary Message */
    formElement
      .querySelectorAll(".temporary-message")
      .forEach((input) => input.remove());

    /** Validate fields with rules */
    Object.entries(fields).forEach(([name, { value, ...rules }]) => {
      const valueReference = value ? `[value='${value}']` : "";
      let hasError = false;
      let field = document.querySelector(
        `${form} [name='${name}']${valueReference}`
      );

      if (!!rules.ref)
        field = document.querySelector(
          `${form} [data-ref='${rules.ref}']${valueReference}`
        );
      if (!field)
        throw new Error(
          `Não foi possível encontrar o campo: ${name}. error_validation`
        );
      if (field.disabled == true) return;

      const label = field.dataset.label;

      if (!field) return errors.push([label, errorsMensagens.notFound]);

      /** Clean invalid Status */
      field.setCustomValidity("");

      Object.entries(rules).forEach(async ([ruleLabel, ruleValue]) => {
        const exec = globals[ruleLabel];
        let isExceptionValid = true;

        if (ruleLabel == "exceptions" || ruleLabel == "ref") return null;
        if (
          Object.entries(rules).filter(
            ([referenceRuleLabel]) => referenceRuleLabel == "exceptions"
          ).length > 0
        )
          Object.entries(rules.exceptions).map(
            async ([exceptionFuction, exceptionValues]) => {
              const execExceptions = exceptions[exceptionFuction];

              if (!execExceptions)
                return console.log(
                  `error_${ruleLabel}:Não foi possível encontrar a validação de ${name}`
                );

              return (isExceptionValid = await execExceptions(
                exceptionValues,
                field
              ));
            }
          );

        if (!isExceptionValid) return null;
        if (!exec)
          return console.log(
            `error_${ruleLabel}:Não foi possível encontrar a validação de ${name}`
          );

        const response = await exec(ruleValue, field);

        if (hasError == true) hasError = !!response;
        return response &&
          errors.filter(
            (error) => error.field == label && error.ref == rules.ref
          ).length == 0
          ? errors.push({
              label: label,
              ref: field,
              message: String(response),
            })
          : null;
      });
    });

    return {
      errors,
      hasError: errors.length > 0,
    };
  };

  this.validField = async (rule, form) => {
    if (!form) throw new Error(errorsMensagens.notFoundForm);

    /** Validate fields with rules */
    const [name, { value, ...rules }] = rule;

    const valueReference = value ? `[value='${value}']` : "";
    let field = form.querySelector(`[name='${name}']${valueReference}`);

    if (!!rules.ref)
      field = form.querySelector(`[data-ref='${rules.ref}']${valueReference}`);
    if (!field)
      throw new Error(
        `Não foi possível encontrar o campo: ${name}. error_validation`
      );
    if (field.disabled == true) return;

    const label = field.dataset.label;

    if (!field) return errors.push([label, errorsMensagens.notFound]);

    const { targetInvalid } = field.dataset;

    /** Remove Temporary Message */
    document
      .querySelectorAll(`[data-invalid="${targetInvalid}"] .temporary-message`)
      .forEach((input) => input.remove());

    /** Clean invalid Status */
    field.setCustomValidity("");

    Object.entries(rules).forEach(async ([ruleLabel, ruleValue]) => {
      const exec = globals[ruleLabel];
      let isExceptionValid = true;

      if (ruleLabel == "exceptions" || ruleLabel == "ref") return null;
      if (
        Object.entries(rules).filter(
          ([referenceRuleLabel]) => referenceRuleLabel == "exceptions"
        ).length > 0
      )
        Object.entries(rules.exceptions).map(
          ([exceptionFuction, exceptionValues]) => {
            const execExceptions = exceptions[exceptionFuction];

            if (!execExceptions)
              return console.log(
                `error_${ruleLabel}:Não foi possível encontrar a validação de ${name}`
              );

            return (isExceptionValid = execExceptions(exceptionValues, field));
          }
        );

      if (!isExceptionValid) return null;
      if (!exec)
        return console.log(
          `error_${ruleLabel}:Não foi possível encontrar a validação de ${name}`
        );

      const response = await exec(ruleValue, field);

      if (!response) {
        field.classList.remove("is-invalid");
        return field.classList.add("is-valid");
      }

      setTimeout(() => {
        field.setCustomValidity("Invalid field.");
        field.classList.add("is-invalid");
        const group = field.closest("div");
        const tooltipBox = group.querySelector(`.invalid-tooltip`);

        if (tooltipBox) tooltipBox.textContent = response;
      }, 200);
    });
  };
}
