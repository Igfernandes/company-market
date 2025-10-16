export const InviteSchema = {
  name: {
    typeOf: "string",
    noEmpty: true,
    min: 3,
  },
  email: {
    typeOf: "string",
    noEmpty: true,
    email: true,
  },
  role_id: {
    typeOf: "string",
    noEmpty: true
  },

};
