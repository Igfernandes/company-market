import { PasswordCriterion } from "./index.js";
import { locations } from "./locations.js";

export const init = () => {
  const passwords = new PasswordCriterion();
  const { groups } = locations;

  groups.forEach((group) => {
    group.addEventListener("keyup", passwords.handle);
  });
};
