export const AlterPasswordSchema = {
  password: {
    typeOf: "string",
    noEmpty: true,
  },
  "password-confirm": {
    typeOf: "string",
    min: 4,
    noEmpty: true,
    compare: "password",
  },
};
