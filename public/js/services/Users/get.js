import { Snackbar } from "../../components/snackbar/index.js";
import { Ajax } from "../../libs/Ajax/index.js";
import { ApiRoutes } from "../Api.js";

export async function getUsers({ id, ...rest } = {}) {
  const snackbar = new Snackbar();

  try {
    const { users } = ApiRoutes;
    const ajax = new Ajax();

    return await ajax.get(`${users.default}${id ?? ""}`, rest);
  } catch (error) {
    snackbar.show(
      "failed",
      "Aconteceu algo errado com a camada service de GetDataAddress"
    );
  }
}
