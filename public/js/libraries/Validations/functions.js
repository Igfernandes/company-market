import { errors } from "../../constants/errors.js";
import {
  lowercaseRegex,
  numberRegex,
  onlySpaces,
  symbolRegex,
  uppercaseRegex,
  urlRegex,
  VALID_EMAIL_REGEX,
} from "../../constants/regex.js";

export function typeOf(type, field) {
  return typeof field.value == type ? null : errors.typeof;
}

export function noEmpty(value = false, field) {
  if (typeof value != "boolean" && value !== true)
    return field.value == value || onlySpaces.test(field.value)
      ? null
      : errors.noEmpty;

  return !field.value || field.value == " " || onlySpaces.test(field.value)
    ? errors.noEmpty
    : null;
}

const separator = {
  br: "/",
  eua: "-",
};

export function date(format = "br", { value }) {
  if (!value) return;
  let error = null;
  const date = value.split(separator[format]);

  if (
    date.length < 3 ||
    date[0] < 1 ||
    date[0] > 31 ||
    date[1] > 12 ||
    date[1] < 1
  )
    return errors.notValidDate;

  switch (format) {
    case "br":
      error = date[0].length != 2 || date[1].length != 2 ? errors.typeof : null;
      error = date[2] && date[2].length != 4 ? errors.typeof : null;
      break;
    case "eua":
      error = date[1].length != 2 || date[2].length != 2 ? errors.typeof : null;
      error = date[0].length != 4 ? errors.typeof : null;
      break;
  }

  return error;
}

export function min(min, field) {
  return field.value.length >= min ? null : errors.min.replace("${min}", min);
}

export function max(max, field) {
  return field.value.length <= max ? null : errors.max.replace("${max}", max);
}

export function length(length, field) {
  return field.value.length == length
    ? null
    : errors.length.replace("${length}", max);
}

export function file(limite = 8048576, field) {
  if (field.type != "file" || field.value == null || !field.files[0]) return;
  if (field.files[0].size > limite && limite !== true)
    return errors.fileLimite.replace("${limite}", limite);
  else if (limite === true && field.files[0].size > 8048576)
    return errors.fileLimite.replace("${limite}", "8MB");
}

export function compare(reference, field) {
  if (!field) return errors.notFound;

  const formReference = field.closest("form");
  const fieldReference = formReference.querySelector(`[name='${reference}']`);

  if (!fieldReference) return errors.notFound;
  if (fieldReference.value != field.value)
    return errors.notEquals
      .replace("${reference}", fieldReference.dataset.label)
      .replace("${field}", field.dataset.label);
}

export function regex(regex, field) {
  return regex.test(field.value)
    ? null
    : errors.regex.replace("${field}", field.dataset.label);
}

export function dateRange({ min, max }, field) {
  const fieldDate = field.value;
  if (fieldDate) {
    const arrDateRemove = fieldDate.split("/");
    const dateEdit =
      arrDateRemove[1] + "-" + arrDateRemove[0] + "-" + arrDateRemove[2];
    const dataFormated = new Date(dateEdit);

    if (min) {
      const minDate = new Date(min.year, min.month, min.day);
      return minDate.getTime() > dataFormated.getTime()
        ? errors.dateMin.replace("${data}", minDate.toLocaleDateString())
        : null;
    }
    if (max) {
      const maxDate = new Date(max.year, max.month, max.day);
      return maxDate.getTime() < dataFormated.getTime()
        ? errors.dateMax.replace("${data}", maxDate.toLocaleDateString())
        : null;
    }
  }
}

export function password(passord, field) {
  if (!field) return errors.notFound;

  const inputValue = field.value;
  if (!inputValue) return;

  if (!lowercaseRegex.test(inputValue))
    return errors.notValidPassword.replace(
      "${validPassword}",
      " pelo menos 1 letra minuscula"
    );
  if (!uppercaseRegex.test(inputValue))
    return errors.notValidPassword.replace(
      "${validPassword}",
      " pelo menos 1 letra maiuscula"
    );
  if (!symbolRegex.test(inputValue))
    return errors.notValidPassword.replace(
      "${validPassword}",
      " pelo menos 1 caracter especial"
    );
  if (!numberRegex.test(inputValue))
    return errors.notValidPassword.replace(
      "${validPassword}",
      " pelo menos 1 numero"
    );

  return null;
}

export function email(email, field) {
  if (!field) return errors.notFound;

  const inputValue = field.value;
  if (!inputValue) return;
  if (!VALID_EMAIL_REGEX.test(inputValue)) return errors.notValidEmail;
}

export function telephone(telephone, field) {
  if (!field) return errors.notFound;

  const inputValue = field.value;
  if (!inputValue) return;
}

export function url(url, field) {
  if (!field) return errors.notFound;

  if (field.value && !urlRegex.test(field.value))
    return errors.notValidUrl.replace("${reference}", field.dataset.label);
}

export function relationFields({ refs, value, refValue }, field) {
  for (const index in refs) {
    if (field && field.value != value[index]) continue;

    const ref = refs[index];
    let refElement = document.querySelector(`[name='${ref}']`);

    if (!refElement)
      throw new Error(`O elemento html '${ref}' não foi encontrado.`);

    const label = refElement.dataset.label;

    if (["radio", "checkbox"].includes(refElement.type)) {
      refElement = document.querySelector(
        `[name='${ref}'][value='${refValue[index]}']`
      );

      if (!refElement)
        throw new Error(`O elemento html '${ref}' não foi encontrado.`);
      if (!refElement.checked)
        return errors.notRelationFields.replace("${reference}", label);
    }

    if (
      (refValue[index] && refValue[index] != refElement.value) ||
      !refElement.value
    )
      return errors.notRelationFields.replace("${reference}", label);
  }
}

export function requiredIfNotEmpty({ ref, value }, field) {
  const refField = document.querySelector(`[name='${ref}']`);

  if (!refField)
    throw new Error(`O elemento html '${ref}' não foi encontrado.`);

  if (refField.value == value && !field.value) return errors.noEmpty;
}

export async function hasField(
  { callbackService, refColumn, shapeData },
  field
) {
  if (!field.value) return;

  const { exceptionValue } = field.dataset;

  if (
    (exceptionValue && field.value == exceptionValue) ||
    (shapeData && !shapeData.test(field.value))
  )
    return;

  const payload = {};
  payload[refColumn] = field.value;

  const { data: resp } = await callbackService(payload);

  const label = field.dataset.label;

  if (resp.isAvaliable !== false) return;

  field.value = "";
  return errors.hasField.replace("${field}", label);
}

export function match(regex, field) {
  const label = field.dataset.label;

  if (!regex.test(field.value)) return errors.match.replace("${field}", label);
}

export default {
  typeOf,
  noEmpty,
  date,
  min,
  max,
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
