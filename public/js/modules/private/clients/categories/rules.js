export const CategorySchema = {
  name: {
    typeOf: "string",
    min: 3,
    max: 100,
  },
  description: {
    typeOf: "string",
    max: 255,
  },
};
