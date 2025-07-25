export const RecoverPasswordSchema = {
  email: {
    typeOf: "string",
    noEmpty: true,
    email: true,
  },
};
