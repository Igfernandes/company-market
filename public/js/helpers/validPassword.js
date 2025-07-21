import {
  lowercaseRegex,
  numberRegex,
  symbolRegex,
  uppercaseRegex,
} from "../constants/regex.js";

export function validPassword(password) {
  const criterions = {
    minuscula: lowercaseRegex,
    maiuscula: uppercaseRegex,
    numero: numberRegex,
    especial: symbolRegex,
  };
  const criterionsNotAcceptOfPassword = new Array();

  Object.entries(criterions).forEach(([index, criterion]) => {
    if (!criterion.test(password)) criterionsNotAcceptOfPassword.push(index);
  });

  return criterionsNotAcceptOfPassword.length > 0
    ? criterionsNotAcceptOfPassword
    : true;
}
