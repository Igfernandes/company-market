import { Snackbar } from "../../../components/snackbar/index.js";
import { Ajax } from "../../../libs/Ajax/index.js";
import { ApiRoutes } from "../../Api.js";

export async function patchRecoverPasswordConfirm({ token } = {}) {
  const snackbar = new Snackbar();

  try {
    const ajax = new Ajax();
    const { users } = ApiRoutes;

    return await ajax.custom(
      users.default,
      {
        op: "replace",
        path: "confirm/password",
        data: {
          token,
        },
      },
      {
        method: "PATCH",
      }
    );
  } catch (error) {
    snackbar.show(
      "failed",
      "Aconteceu algo errado com a camada service de PatchRecoverPassword"
    );
  }
}
