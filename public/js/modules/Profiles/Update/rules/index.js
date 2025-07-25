import { addressFieldsRules } from "./addressFields.js";
import { personalInformationRules } from "./personalInformation.js";

export const rules = {
  ...addressFieldsRules,
  ...personalInformationRules,
};

