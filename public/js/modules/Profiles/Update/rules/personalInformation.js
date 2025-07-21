/**
 * @constant { object } personalInformationRules
 */
export const personalInformationRules = {
  name: {
    typeOf: "string",
    noEmpty: true,
    min: 1,
  },
  birthdate: {
    typeOf: "string",
    noEmpty: true,
    date: "br",
    min: 1,
    max: 10,
    dateRange: {
      max: {
        year: new Date().getFullYear(),
        month: new Date().getMonth(),
        day: new Date().getDate(),
      },
    },
  },
  phone: {
    typeOf: "string",
    telephone: true,
  },
  cell: {
    typeOf: "string",
    telephone: true,
  },
};
