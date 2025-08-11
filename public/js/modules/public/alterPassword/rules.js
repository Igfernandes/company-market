export const AlterPasswordSchema = {
  password: {
    typeOf: "string",
    noEmpty: true,
  },
  "confirmation": {
    typeOf: "string",
    min: 4,
    noEmpty: true,
    compare: "password",
  },
};
