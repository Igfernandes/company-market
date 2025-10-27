import { ModalsModule } from "../../../../components/shared/utils/modal/exports.js";
import { TableModules } from "../../../../components/shared/layouts/table/exports.js";
import { deleteCompany } from "../../../../services/companies/delete.js";

export function CompanyDeleteForm() {
  const ModalKey = "company_delete";
  this.handleClick = async (ev) => {
    const btn = ev.target;
    const companyId = TableModules.getDeleteKey(btn);

    ModalsModule.show(ModalKey);

    const cancelBtn = ModalsModule.getLeftButton(ModalKey);
    cancelBtn.addEventListener("click", () => ModalsModule.close(ModalKey));
    const confirmBtn = ModalsModule.getRightButton(ModalKey);

    confirmBtn.addEventListener("click", async () => {
      const { success } = await deleteCompany({
        id: companyId,
      });

      if (success) {
        TableModules.load("companies");
        ModalsModule.close(ModalKey);
      }
    });
  };
}
