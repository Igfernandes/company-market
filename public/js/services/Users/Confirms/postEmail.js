import { Snackbar } from "../../../components/snackbar/index.js";
import { Ajax } from "../../../libs/Ajax/index.js";
import { ApiRoutes } from "../../Api.js";

export async function postConfirmEmail({ email } = {}) {
  const snackbar = new Snackbar();

  try {
    const ajax = new Ajax();
    const { users } = ApiRoutes;

    return await ajax.custom(
      users.default,
      {
        op: "replace",
        path: "confirm/email",
        data: {
          email,
        },
      },
      {
        method: "PATCH",
      }
    );
  } catch (error) {
    snackbar.show(
      "failed",
      "Aconteceu algo errado com a camada service de PostConfirmEmail"
    );
  }
}
