import { postExport } from "../../../services/exports/post.js";
import { snackbar } from "./snackbar.js";

export const init = () => {
  const exportsBtn = Array.from(
    document.querySelectorAll("[component='exports'] [export-entity]")
  );

  exportsBtn.forEach((btn) => {
    btn.addEventListener("click", () => {
      const entity = btn.getAttribute("export-entity");
      const targetsId = btn.getAttribute("export-target");
      const exportType = btn.getAttribute("export-type");

      if (!exportType || !entity) {
        return snackbar.execute("NOTICE", {
          title: "Atenção",
          message:
            "A exportação encontra-se com problemas, recarregue a página e tente novamente.",
        });
      }

      postExport({
        entity,
        in_ids: targetsId ? targetsId.split(",") : [],
        type: exportType,
      });
    });
  });
};
