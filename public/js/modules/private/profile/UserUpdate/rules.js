export const UserUpdateSchema = {
  name: {
    typeOf: "string",
    min: 3,
    max: 100,
  },
  document: {
    typeOf: "string",
    min: 3,
    max: 25,
  },
  phone: {
    typeOf: "string",
    min: 4,
    max: 20,
  },
  birthdate: {
    typeOf: "string",
    date: "eua",
  },
  keyword: {
    typeOf: "string",
  },
  email: {
    typeOf: "string",
    email: true,
  },
};
