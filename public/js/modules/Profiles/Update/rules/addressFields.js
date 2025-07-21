import { validCEP } from "../../../../constants/regex.js";

/**
 * @constant { object } addressFieldsRules
 */
export const addressFieldsRules = {
  zipcode: {
    typeOf: "string",
    min: 9,
    max: 9,
    noEmpty: true,
    regex: validCEP,
  },
  country: {
    typeOf: "string",
    noEmpty: true,
  },
  state: {
    typeOf: "string",
    noEmpty: true,
  },
  city: {
    typeOf: "string",
    noEmpty: true,
  },
  district: {
    typeOf: "string",
    noEmpty: true,
  },
  street: {
    typeOf: "string",
    noEmpty: true,
  },
  number: {
    typeOf: "string",
    min: 1,
    max: 6,
    noEmpty: true,
  },
  complement: {
    typeOf: "string",
  },
};
