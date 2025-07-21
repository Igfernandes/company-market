import { Snackbar } from "../../../components/snackbar/index.js";
import {
  lowercaseRegex,
  numberRegex,
  symbolRegex,
  uppercaseRegex,
} from "../../../constants/regex.js";
export function PasswordCriterion() {
  this.handle = (ev) => {
    const password = ev.currentTarget;
    const group = password.closest("[data-password-group]");
    const fields = group.querySelectorAll("[data-criterion-password]");

    const criterion = {
      minuscula: lowercaseRegex,
      maiuscula: uppercaseRegex,
      numero: numberRegex,
      especial: symbolRegex,
    };
    const form = password.closest("form");

    fields.forEach((field) => {
      if (criterion[field.dataset.criterionPassword].test(password.value)) {
        field.querySelector("svg").style = "fill:green";
      } else {
        field.querySelector("svg").style = "fill:#cf0000";
      }
    });

    form.addEventListener("submit", (ev) => {
      const snackbar = new Snackbar();

      for (const field of fields) {
        if (!criterion[field.dataset.criterionPassword].test(password.value)) {
          ev.preventDefault();
          return snackbar.show(
            "failed",
            "A senha não atende aos critérios mínimos de segurança."
          );
        }
      }
    });
  };
}
