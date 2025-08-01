import {
  getRecaptchaToken,
  loadRecaptcha,
} from "../../../helpers/recaptcha.js";
import { redirect } from "../../../helpers/route.js";
import { Validations } from "../../../libraries/Validations/index.js";
import { postAuth } from "../../../services/authentications/post.js";
import { WEB_ROUTES } from "../../../settings/web.js";
import { loginSchema } from "./rules.js";

export function LoginForm() {
  this.handleSubmit = async (ev) => {
    ev.preventDefault();
    const form = ev.currentTarget;

    this.btnSubmit(form, true);

    const payload = new FormData(form);
    const validations = new Validations(form);

    const formValid = await validations.execute(loginSchema);

    if (formValid.length > 0) {
      this.btnSubmit(form, false);
      return;
    }

    payload.append("recaptcha", getRecaptchaToken());

    const { success } = (await postAuth(payload)) ?? {};

    setTimeout(() => {
      if (!success) {
        loadRecaptcha();
        return this.btnSubmit(form, false);
      }

      redirect(WEB_ROUTES.dashboard.overview);
    }, 300);
  };

  this.btnSubmit = (form, status = false) => {
    const button = form.querySelector("button[type='submit']");

    if (!status) button.removeAttribute("disabled");
    else button.disabled = status;

    button.setAttribute("data-loading", String(status));
  };
}
