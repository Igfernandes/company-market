import { Snackbar } from "../../components/snackbar/index.js";
import { Ajax } from "../../libs/Ajax/index.js";
import { ApiRoutes } from "../Api.js";

export async function postValidatorsCnpj(payload = {}) {
  const snackbar = new Snackbar();

  try {
    const ajax = new Ajax();
    const { companies } = ApiRoutes;

    return await ajax.post(companies.data.post("cnpj"), payload);
  } catch (error) {
    snackbar.show(
      "failed",
      "Aconteceu algo errado com a camada service de PostValidatorsCpf"
    );
  }
}
