import { Validations } from "../../../libs/Validations/index.js";
import { Snackbar } from "../../../components/snackbar/index.js";
import { locations } from "./locations.js";
import { rules } from "./rules/index.js";
import { Load } from "../../../components/shared/layout/Load.js";
import { FormBuilder } from "../../../libs/Formio/index.js";
import { getCustomForms } from "../../../services/CustomForms/get.js";
import { Navigation } from "../../../libs/Navigation/index.js";

export function UpdateProfileForm() {
  this.handle = async (ev) => {
    try {
      ev.preventDefault();
      const { form, btnSubmit } = locations;

      const validations = new Validations();
      const snackbar = new Snackbar();

      const dataValidate = await validations.init(
        rules,
        `[data-send="${form.dataset.send}"]`
      );

      if (dataValidate.errors.length > 0) {
        return snackbar.show(
          "failed",
          "Você preencheu alguns campos incorretamente."
        );
      }

      const load = Load(btnSubmit);
      form.submit().then(() => {
        load.remove();
      });
    } catch (err) {
      throw new Error(err);
    }
  };

  this.customForm = async () => {
    const { contentForm } = locations;
    const formBuilder = new FormBuilder();
    const navigation = new Navigation();

    const { data: customForm } = await getCustomForms({
      id: navigation.getParam("customized"),
    });

    const components =
      customForm.length > 0 ? JSON.parse(customForm[0].components) : [];

    const form = await formBuilder.create(contentForm, components);

    form.submission = {
      data: customForm[0].values,
    };

    form.on("submit", function () {
      contentForm.closest("form").submit();
    });
  };
}
