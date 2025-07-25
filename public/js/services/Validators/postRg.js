import { Snackbar } from "../../components/snackbar/index.js";
import { Ajax } from "../../libs/Ajax/index.js";
import { ApiRoutes } from "../Api.js";

export async function postValidatorsRg(payload = {}) {
  const snackbar = new Snackbar();

  try {
    const ajax = new Ajax();
    const { users } = ApiRoutes;

    return await ajax.post(users.data.post("rg"), payload);
  } catch (error) {
    snackbar.show(
      "failed",
      "Aconteceu algo errado com a camada service de PostValidatorsCpf"
    );
  }
}
