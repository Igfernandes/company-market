import { VALID_CNPJ, VALID_CPF_CNPJ } from "../../../constants/regex.js";
import { postValidatorsCnpj } from "../../../services/Validators/postCnpj.js";

export const federationFieldsRules = {
  "federation[name]": {
    typeOf: "string",
    requiredIfNotEmpty: {
      ref: "account",
      value: "federation",
    },
  },
  "federation[cnpj]": {
    typeOf: "string",
    regex: VALID_CNPJ,
    requiredIfNotEmpty: {
      ref: "account",
      value: "federation",
    },
    hasField: {
      refColumn: "cnpj",
      callbackService: postValidatorsCnpj,
      shapeData: VALID_CNPJ,
    },
  },
  "federation[acronym]": {
    typeOf: "string",
    requiredIfNotEmpty: {
      ref: "account",
      value: "federation",
    },
  },
  "federation[ie]": {
    typeOf: "string",
    requiredIfNotEmpty: {
      ref: "account",
      value: "federation",
    },
  },
};
