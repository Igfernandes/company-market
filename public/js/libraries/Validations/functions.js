/**
 * Validações de campos de formulário reutilizáveis.
 * Cada função exportada representa uma regra de validação específica.
 */

import { errors } from "../../constants/errors.js";
import {
  lowercaseRegex,
  numberRegex,
  symbolRegex,
  uppercaseRegex,
  urlRegex,
  VALID_EMAIL_REGEX,
} from "../../constants/regex.js";

/**
 * Verifica se o valor do campo corresponde ao tipo especificado.
 * @param {string} type - Tipo esperado (ex: "string", "number").
 * @param {HTMLInputElement} field - Campo a ser validado.
 * @returns {string|null}
 */
export function typeOf(type, field) {
  return typeof field.value === type ? null : errors.typeof;
}

/**
 * Verifica se o campo está vazio.
 * @param {boolean} [value=false]
 * @param {HTMLInputElement} field
 * @returns {string|null}
 */
export function noEmpty(value = false, field) {
  const isInvalid =
    (typeof value !== "boolean" && field.value != value) || !field.value.trim();
  return isInvalid ? errors.noEmpty : null;
}

const dateSeparators = { br: "/", eua: "-" };

/**
 * Valida uma data com base no formato especificado.
 * @param {"br"|"eua"} format
 * @param {{ value: string }} field
 * @returns {string|null|undefined}
 */
export function date(format = "br", { value }) {
  if (!value) return;
  const parts = value.split(dateSeparators[format]);
  if (parts.length < 3) return errors.notValidDate;

  const [d1, d2, d3] = parts.map(Number);
  if (d1 < 1 || d2 < 1 || d1 > 31 || d2 > 12) return errors.notValidDate;

  switch (format) {
    case "br":
      if (
        d1.toString().length !== 2 ||
        d2.toString().length !== 2 ||
        d3.toString().length !== 4
      )
        return errors.typeof;
      break;
    case "eua":
      if (
        d1.toString().length !== 4 ||
        d2.toString().length !== 2 ||
        d3.toString().length !== 2
      )
        return errors.typeof;
      break;
  }

  return null;
}

/**
 * Verifica se o valor tem comprimento mínimo.
 * @param {number} min
 * @param {HTMLInputElement} field
 * @returns {string|null}
 */
export const min = (min, field) =>
  field.value.length >= min ? null : errors.min.replace("${min}", min);

/**
 * Verifica se o valor tem comprimento máximo.
 * @param {number} max
 * @param {HTMLInputElement} field
 * @returns {string|null}
 */
export const max = (max, field) =>
  field.value.length <= max ? null : errors.max.replace("${max}", max);

/**
 * Verifica se o valor tem comprimento exato.
 * @param {number} len
 * @param {HTMLInputElement} field
 * @returns {string|null}
 */
export const length = (len, field) =>
  field.value.length === len ? null : errors.length.replace("${length}", len);

/**
 * Valida tamanho de arquivo enviado.
 * @param {number|true} [limit=8048576]
 * @param {HTMLInputElement} field
 * @returns {string|undefined}
 */
export function file(limit = 8048576, field) {
  if (field.type !== "file" || !field.files?.[0]) return;
  const size = field.files[0].size;
  if ((limit === true && size > 8048576) || (limit !== true && size > limit)) {
    return errors.fileLimite.replace(
      "${limite}",
      limit === true ? "8MB" : limit
    );
  }
}

/**
 * Compara valor de um campo com outro.
 * @param {string} reference
 * @param {HTMLInputElement} field
 * @returns {string|undefined}
 */
export function compare(reference, field) {
  const form = field.closest("form");
  const refField = form?.querySelector(`[name='${reference}']`);
  if (!refField) return errors.notFound;
  if (refField.value !== field.value) {
    return errors.notEquals
      .replace("${reference}", refField.dataset.label)
      .replace("${field}", field.dataset.label);
  }
}

/**
 * Valida o campo com uma regex.
 * @param {RegExp} pattern
 * @param {HTMLInputElement} field
 * @returns {string|null}
 */
export const regex = (pattern, field) =>
  pattern.test(field.value)
    ? null
    : errors.regex.replace("${field}", field.dataset.label);

/**
 * Valida se a data está dentro do intervalo especificado.
 * @param {{min?: Object, max?: Object}} range
 * @param {HTMLInputElement} field
 * @returns {string|null}
 */
export function dateRange({ min, max }, field) {
  if (!field.value) return;

  const [d, m, y] = field.value.split("/").map(Number);
  const current = new Date(`${m}-${d}-${y}`);

  if (min) {
    const minDate = new Date(min.year, min.month, min.day);
    if (current < minDate)
      return errors.dateMin.replace("${data}", minDate.toLocaleDateString());
  }
  if (max) {
    const maxDate = new Date(max.year, max.month, max.day);
    if (current > maxDate)
      return errors.dateMax.replace("${data}", maxDate.toLocaleDateString());
  }

  return null;
}

/**
 * Valida força de senha com letras, símbolos e números.
 * @param {*} _ - Ignorado
 * @param {HTMLInputElement} field
 * @returns {string|null}
 */
export function password(_, field) {
  const value = field?.value;
  if (!value) return;

  if (!lowercaseRegex.test(value))
    return errors.notValidPassword.replace(
      "${validPassword}",
      " pelo menos 1 letra minuscula"
    );
  if (!uppercaseRegex.test(value))
    return errors.notValidPassword.replace(
      "${validPassword}",
      " pelo menos 1 letra maiuscula"
    );
  if (!symbolRegex.test(value))
    return errors.notValidPassword.replace(
      "${validPassword}",
      " pelo menos 1 caracter especial"
    );
  if (!numberRegex.test(value))
    return errors.notValidPassword.replace(
      "${validPassword}",
      " pelo menos 1 numero"
    );

  return null;
}

/**
 * Verifica se o e-mail é válido.
 * @param {*} _ - Ignorado
 * @param {HTMLInputElement} field
 * @returns {string|undefined}
 */
export const email = (_, field) => {
  const value = field?.value;
  if (!value) return;
  if (!VALID_EMAIL_REGEX.test(value)) return errors.notValidEmail;
};

/**
 * Placeholder para validação de telefone.
 * @param {*} _ - Ignorado
 * @param {HTMLInputElement} field
 */
export const telephone = (_, field) => {
  const value = field?.value;
  if (!value) return;
};

/**
 * Valida se a URL do campo é válida.
 * @param {*} _ - Ignorado
 * @param {HTMLInputElement} field
 * @returns {string|undefined}
 */
export const url = (_, field) => {
  const value = field?.value;
  if (value && !urlRegex.test(value)) {
    return errors.notValidUrl.replace("${reference}", field.dataset.label);
  }
};

/**
 * Valida dependência entre campos.
 * @param {{refs: string[], value: string[], refValue: string[]}} obj
 * @param {HTMLInputElement} field
 * @returns {string|undefined}
 */
export function relationFields({ refs, value, refValue }, field) {
  for (let i = 0; i < refs.length; i++) {
    if (field && field.value !== value[i]) continue;

    let refElement = document.querySelector(`[name='${refs[i]}']`);
    if (!refElement)
      throw new Error(`O elemento html '${refs[i]}' não foi encontrado.`);

    const label = refElement.dataset.label;

    if (["radio", "checkbox"].includes(refElement.type)) {
      refElement = document.querySelector(
        `[name='${refs[i]}'][value='${refValue[i]}']`
      );
      if (!refElement)
        throw new Error(`O elemento html '${refs[i]}' não foi encontrado.`);
      if (!refElement.checked)
        return errors.notRelationFields.replace("${reference}", label);
    }

    if (
      (refValue[i] && refElement.value !== refValue[i]) ||
      !refElement.value
    ) {
      return errors.notRelationFields.replace("${reference}", label);
    }
  }
}

/**
 * Torna campo obrigatório se o campo de referência tiver determinado valor.
 * @param {{ref: string, value: string}} obj
 * @param {HTMLInputElement} field
 * @returns {string|undefined}
 */
export function requiredIfNotEmpty({ ref, value }, field) {
  const refField = document.querySelector(`[name='${ref}']`);
  if (!refField)
    throw new Error(`O elemento html '${ref}' não foi encontrado.`);
  if (refField.value === value && !field.value) return errors.noEmpty;
}

/**
 * Verifica via API se valor do campo já existe.
 * @async
 * @param {{ callbackService: function, refColumn: string, shapeData?: RegExp }} param
 * @param {HTMLInputElement} field
 * @returns {Promise<string|undefined>}
 */
export async function hasField(
  { callbackService, refColumn, shapeData },
  field
) {
  if (!field?.value) return;

  const { exceptionValue } = field.dataset;

  if (
    (exceptionValue && field.value === exceptionValue) ||
    (shapeData && !shapeData.test(field.value))
  )
    return;

  const payload = { [refColumn]: field.value };
  const { data: resp } = await callbackService(payload);

  if (resp?.isAvaliable !== false) return;

  field.value = "";
  return errors.hasField.replace("${field}", field.dataset.label);
}

/**
 * Verifica se campo corresponde ao padrão informado.
 * @param {RegExp} pattern
 * @param {HTMLInputElement} field
 * @returns {string|null}
 */
export const match = (pattern, field) =>
  !pattern.test(field.value)
    ? errors.match.replace("${field}", field.dataset.label)
    : null;

export default {
  typeOf,
  noEmpty,
  date,
  min,
  max,
  length,
  file,
  compare,
  dateRange,
  password,
  email,
  telephone,
  url,
  relationFields,
  regex,
  requiredIfNotEmpty,
  hasField,
  match,
};
