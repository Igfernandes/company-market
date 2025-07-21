import {
  LENGTH_CHARACTERES,
  VALID_CPF_CNPJ,
  VALID_EMAIL_REGEX,
} from "../../../constants/regex.js";
import { postValidatorsCpf } from "../../../services/Validators/postCpf.js";
import { postValidatorsEmail } from "../../../services/Validators/postEmail.js";
import { postValidatorsRg } from "../../../services/Validators/postRg.js";

/**
 * @constant { object } personalInformationRules
 */
export const personalInformationRules = {
  name: {
    typeOf: "string",
    noEmpty: true,
    min: 1,
  },
  login: {
    typeOf: "string",
    noEmpty: true,
    email: true,
    match: VALID_EMAIL_REGEX,
    hasField: {
      refColumn: "login",
      callbackService: postValidatorsEmail,
      shapeData: VALID_EMAIL_REGEX,
    },
  },
  birthdate: {
    typeOf: "string",
    noEmpty: true,
    date: "br",
    min: 1,
    max: 10,
    dateRange: {
      max: {
        year: new Date().getFullYear(),
        month: new Date().getMonth(),
        day: new Date().getDate(),
      },
    },
  },
  cpf: {
    typeOf: "string",
    min: 1,
    max: 14,
    noEmpty: true,
    match: VALID_CPF_CNPJ,
    hasField: {
      refColumn: "cpf",
      callbackService: postValidatorsCpf,
      shapeData: VALID_CPF_CNPJ,
    },
  },
  rg: {
    typeOf: "string",
    min: 1,
    noEmpty: true,
    hasField: {
      refColumn: "rg",
      callbackService: postValidatorsRg,
      shapeData: LENGTH_CHARACTERES(5),
    },
  },
  phone: {
    typeOf: "string",
    telephone: true,
  },
  cell: {
    typeOf: "string",
    telephone: true,
  },
  password: {
    typeOf: "string",
    min: 4,
    noEmpty: true,
    password: true,
  },
  password_confirm: {
    typeOf: "string",
    min: 4,
    noEmpty: true,
    compare: "password",
  },
};
