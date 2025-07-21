import { FormBuilder } from "../../../../libs/Formio/index.js";
import { postCustomForms } from "../../../../services/CustomForms/post.js";
import { getCustomForms } from "../../../../services/CustomForms/get.js";
import { locations } from "./locations.js";
import { Navigation } from "../../../../libs/Navigation/index.js";

export function CustomFields() {
  this.execute = async () => {
    const { content, fieldPage } = locations;
    const formBuilder = new FormBuilder();
    const navigation = new Navigation();

    const { data: customForm } = await getCustomForms({
      id: navigation.getParam("customized"),
    });

    const components =
      customForm.length > 0 ? JSON.parse(customForm[0].components) : [];

    const builder = await formBuilder.builder(content, components);
    builder.on("change", async function () {
      await postCustomForms({
        components: builder.schema.components,
        page: fieldPage.value,
      });
    });
  };
}
