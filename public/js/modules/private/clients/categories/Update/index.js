import { TableModules } from "../../../../../components/shared/layouts/table/exports.js";
import { ModalsModule } from "../../../../../components/shared/utils/modal/exports.js";
import { hydrateForm } from "../../../../../helpers/form.js";
import { Validations } from "../../../../../libraries/Validations/index.js";
import { getCategories } from "../../../../../services/clients/categories/get.js";
import { putCategory } from "../../../../../services/clients/categories/put.js";
import { TABLE_CATEGORY_ID } from "../constants.js";
import { CategorySchema } from "../rules.js";

export function CategoryUpdate() {
  const modalKey = "update";

  this.handleClick = async (option) => {
    const categories = await getCategories();

    const leftBtn = ModalsModule.getLeftButton(modalKey);
    leftBtn.addEventListener("click", () => ModalsModule.close(modalKey));

    const rightBtn = ModalsModule.getRightButton(modalKey);
    const roleId = option.getAttribute("option-key");

    const currentRole = categories.find((role) => role.id == roleId);

    const form = hydrateForm("[send='category-update']", currentRole);
    ModalsModule.show(modalKey);

    rightBtn.addEventListener(
      "click",
      async () => {
        rightBtn.disabled = true;
        await this.handleSubmit(form, roleId);
        rightBtn.disabled = false;
      },
      { once: true }
    );
  };

  this.handleSubmit = async (form, roleId) => {
    const payload = new FormData(form);
    const validations = new Validations(form);

    const formValid = await validations.execute(CategorySchema);

    if (formValid.length === 0) {
      const { success } = await putCategory({
        id: roleId,
        name: payload.get("name"),
        description: payload.get("description"),
      });

      if (!success) return;

      TableModules.load(TABLE_CATEGORY_ID);
      form.reset();
      ModalsModule.close(modalKey);
    }
  };
}
