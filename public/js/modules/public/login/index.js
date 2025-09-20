import { RecaptchaModules } from "../../../components/shared/utils/recaptcha/exports.js";
import cookies from "../../../helpers/cookies/index.js";
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

    RecaptchaModules.init(
      (token) => {
        payload.append("recaptcha", token);
        this.sendLogin(form, payload);
      },
      () => this.btnSubmit(form)
    );
  };

  this.sendLogin = async (form, payload) => {
    const { success, reference_token } = (await postAuth(payload)) ?? {};
    setTimeout(() => {
      if (!success) {
        RecaptchaModules.load();
        return this.btnSubmit(form, false);
      }

      this.rememberMe(reference_token);
      redirect(WEB_ROUTES.dashboard.overview);
    }, 300);
  };

  this.rememberMe = (referenceToken) => {
    if (!referenceToken) return;

    cookies.set("rm_token", referenceToken);
  };

  this.btnSubmit = (form, status = false) => {
    const button = form.querySelector("button[type='submit']");

    if (!status) button.removeAttribute("disabled");
    else button.disabled = status;

    button.setAttribute("data-loading", String(status));
  };
}
