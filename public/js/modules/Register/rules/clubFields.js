import { VALID_CNPJ } from "../../../constants/regex.js";
import { postValidatorsCnpj } from "../../../services/Validators/postCnpj.js";

export const clubFieldsRules = {
  "club[name]": {
    typeOf: "string",
    requiredIfNotEmpty: {
      ref: "account",
      value: "club",
    },
  },
  "club[cnpj]": {
    typeOf: "string",
    regex: VALID_CNPJ,
    requiredIfNotEmpty: {
      ref: "account",
      value: "club",
    },
    hasField: {
      refColumn: "cnpj",
      callbackService: postValidatorsCnpj,
      shapeData: VALID_CNPJ,
    },
  },
  "club[acronym]": {
    typeOf: "string",
    requiredIfNotEmpty: {
      ref: "account",
      value: "club",
    },
  },
  "club[ie]": {
    typeOf: "string",
    requiredIfNotEmpty: {
      ref: "account",
      value: "club",
    },
  },
  "club[has_federation]": {
    typeOf: "string",
    requiredIfNotEmpty: {
      ref: "account",
      value: "club",
    },
  },
};
