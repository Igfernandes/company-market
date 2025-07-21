import { Snackbar } from "../../components/snackbar/index.js";
import { Ajax } from "../../libs/Ajax/index.js";
import { ApiRoutes } from "../Api.js";

export async function getCustomForms({ page, status, id } = {}) {
  const snackbar = new Snackbar();

  try {
    const ajax = new Ajax();
    const { customForms } = ApiRoutes;

    return await ajax.get(customForms.get(id), { page, status });
  } catch (error) {
    snackbar.show(
      "failed",
      "Aconteceu algo errado com a camada service de GetCustomForms"
    );
  }
}
