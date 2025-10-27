import { TableModules } from "../../../../../components/shared/layouts/table/exports.js";
import { handleLoading } from "../../../../../helpers/form.js";
import { Validations } from "../../../../../libraries/Validations/index.js";
import { postCategory } from "../../../../../services/clients/categories/post.js";
import { TABLE_CATEGORY_ID } from "../constants.js";
import { CategorySchema } from "../rules.js";

export function UserCategoryCreate() {
  this.handleSubmit = async (ev) => {
    ev.preventDefault();
    const form = ev.currentTarget;
    handleLoading(form, true);

    const payload = new FormData(form);
    const validations = new Validations(form);

    const formValid = await validations.execute(CategorySchema);

    if (formValid.length === 0) {
      const { success } = await postCategory(payload);

      if (success) {
        TableModules.load(TABLE_CATEGORY_ID);
        form.reset();
      }
    }

    handleLoading(form, false, "Salvar");
  };
}
