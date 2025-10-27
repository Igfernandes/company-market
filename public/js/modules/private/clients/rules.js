export const ClientSchema = {
  name: {
    typeOf: "string",
    min: 3,
    max: 150,
  },
  status: {
    typeOf: "string",
  },
  email: {
    typeOf: "string",
    email: true,
  },
  phone: {
    typeOf: "string",
    min: 11,
    max: 20,
  },
  birthdate: {
    typeOf: "string",
    date: "eua",
  },
  document: {
    typeOf: "string",
    max: 30,
  },
  document_type: {
    typeOf: "string",
    max: 35,
  },
  category: {
    typeOf: "string",
  },
};
