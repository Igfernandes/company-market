export const athleteFieldsRules = {
  is_athlete: {
    typeOf: "string",
    requiredIfNotEmpty: {
      ref: "account",
      value: "affiliate",
    },
  },
  "has_position[]": {
    requiredIfNotEmpty: {
      ref: "account",
      value: "affiliate",
    },
  },
  has_club: {
    typeOf: "string",
    requiredIfNotEmpty: {
      ref: "account",
      value: "affiliate",
    },
  },
  has_federation: {
    typeOf: "string",
    requiredIfNotEmpty: {
      ref: "account",
      value: "affiliate",
    },
  },
};
