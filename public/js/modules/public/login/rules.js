export const loginSchema = {
  login: {
    typeOf: "string",
    noEmpty: true,
    email: true,
  },
  password: {
    typeOf: "string",
    noEmpty: true,
  },
};
