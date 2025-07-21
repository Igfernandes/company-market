import { Validations } from "../../libs/Validations/index.js";
import { Snackbar } from "../../components/snackbar/index.js";
import { locations } from "./locations.js";
import { rules } from "./rules/index.js";
import { changeScenes } from "../Others/TradeScenes/utils/changeScenes.js";
import { Load } from "../../components/shared/layout/Load.js";
import { clubFieldsRules } from "./rules/clubFields.js";
import { athleteFieldsRules } from "./rules/athleteFields.js";
import { federationFieldsRules } from "./rules/federationFields.js";

export function RegisterForm() {
  this.handle = async (ev) => {
    try {
      ev.preventDefault();
      const RULES = {
        affiliate: athleteFieldsRules,
        club: clubFieldsRules,
        federation: federationFieldsRules,
      };
      const { form, btnSubmit } = locations;
      const fieldTokenEmail = document.querySelector("[name='tokenEmail']");

      const TYPE_CURRENT_ACCOUNT = form.querySelector(
        "[name='account']:checked"
      ).value;

      const validations = new Validations();
      const snackbar = new Snackbar();

      const dataValidate = await validations.init(
        { ...rules, ...RULES[TYPE_CURRENT_ACCOUNT] },
        `[data-send="${form.dataset.send}"]`
      );

      const errorsFiltered = [];

      for (let x = 0; x < dataValidate.errors.length; x++) {
        if (
          !["club", "federation"].includes(TYPE_CURRENT_ACCOUNT) &&
          dataValidate.errors[x].label == "Cnpj"
        )
          continue;

        errorsFiltered.push(dataValidate.errors[x]);
      }

      if (errorsFiltered.length > 0) {
        const lastFieldIncorrect = errorsFiltered[0].ref;
        const SCENE_WITH_ERROR =
          lastFieldIncorrect.closest("[data-scenes]").dataset.scenes;

        changeScenes(SCENE_WITH_ERROR);

        return snackbar.show(
          "failed",
          "Você preencheu alguns campos incorretamente."
        );
      }

      const policiesPrivacy = document.querySelectorAll(
        "[name='policy_privacy[]']"
      );
      let termsNotAccept = false;

      for (const field of policiesPrivacy) {
        if (!field.checked) termsNotAccept = true;
      }

      if (!fieldTokenEmail.value || fieldTokenEmail.value.lenght > 19)
        return snackbar.show(
          "failed",
          "Você precisa validar o seu e-mail antes de prosseguir.",
          {
            title: "Pendências no formulário:",
          }
        );

      if (termsNotAccept)
        return snackbar.show(
          "failed",
          "Você aceitou os nossos termos e políticas de privicadade."
        );

      const load = Load(btnSubmit);
      form.submit().then(() => {
        load.remove();
      });
    } catch (err) {
      throw new Error(err);
    }
  };
}
