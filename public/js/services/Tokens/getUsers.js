import { Snackbar } from "../../components/snackbar/index.js";
import { Ajax } from "../../libs/Ajax/index.js";
import { ApiRoutes } from "../Api.js";

export async function getTokens({ path, op, data } = {}) {
  const snackbar = new Snackbar();

  try {
    const ajax = new Ajax();
    const { users } = ApiRoutes;

    return await ajax.get(users.usersTokens, { path, op, data });
  } catch (error) {
    snackbar.show(
      "failed",
      "Aconteceu algo errado com a camada service de PostValidatorsCpf"
    );
  }
}
