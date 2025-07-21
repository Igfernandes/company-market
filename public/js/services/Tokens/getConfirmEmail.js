import { Snackbar } from "../../components/snackbar/index.js";
import { Ajax } from "../../libs/Ajax/index.js";
import { ApiRoutes } from "../Api.js";

export async function getConfirmEmail({ token } = {}) {
  const snackbar = new Snackbar();

  try {
    const ajax = new Ajax();
    const { tokens } = ApiRoutes;

    return await ajax.get(tokens.confirmEmail, { token });
  } catch (error) {
    snackbar.show(
      "failed",
      "Aconteceu algo errado com a camada service de GetConfirmEmail"
    );
  }
}
