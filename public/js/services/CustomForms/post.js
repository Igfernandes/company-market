import { Snackbar } from "../../components/snackbar/index.js";
import { Ajax } from "../../libs/Ajax/index.js";
import { ApiRoutes } from "../Api.js";

export async function postCustomForms({ page, components } = {}) {
  const snackbar = new Snackbar();

  try {
    const ajax = new Ajax();
    const { customForms } = ApiRoutes;

    return await ajax.post(customForms.post, { page, components });
  } catch (error) {
    snackbar.show(
      "failed",
      "Aconteceu algo errado com a camada service de PostCustomForms"
    );
  }
}
