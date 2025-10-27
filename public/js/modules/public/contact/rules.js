export const ContactSchema = {
  email: {
    typeOf: "string",
    noEmpty: true,
    email: true,
  },
  name: {
    typeOf: "string",
    noEmpty: true,
  },
  subject: {
    typeOf: "string",
    noEmpty: true,
  },
  message: {
    typeOf: "string",
    noEmpty: true,
  },
};
