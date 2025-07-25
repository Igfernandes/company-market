import { handleRecaptchaTokenUpdate } from "../../../helpers/recaptcha.js";
import { redirect } from "../../../helpers/route.js";
import { Validations } from "../../../libraries/Validations/index.js";
import { postAuth } from "../../../services/authentications/post.js";
import { loginSchema } from "./rules.js";

export function LoginForm() {
  this.handleSubmit = async (ev) => {
    ev.preventDefault();
    const form = ev.currentTarget;

    this.btnSubmit(form, true, "Enviando...");

    const payload = new FormData(form);
    const validations = new Validations();

    const formValid = await validations.execute(loginSchema);

    console.log(formValid)
    if (formValid.length > 0) {
      this.btnSubmit(form, false, "Conectar-se");
      return;
    }

    const resp = await postAuth(payload);
    handleRecaptchaTokenUpdate();

    setTimeout(() => {
      if (resp.errors) {
        this.btnSubmit(form, false, "Conectar-se");
      } else {
        this.btnSubmit(form, true, "Conectado!");
        redirect("/dashboard");
      }
    }, 300);
  };

  this.btnSubmit = (form, isDisabled, text) => {
    const button = form.querySelector("button[type='submit']");
    button.disabled = isDisabled;
    button.innerText = text;
  };
}
