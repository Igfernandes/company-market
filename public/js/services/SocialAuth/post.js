import { Snackbar } from "../../components/snackbar/index.js";
import { Ajax } from "../../libs/Ajax/index.js";
import { ApiRoutes } from "../Api.js";

export async function postSocialAuth(payload = {}) {
  const snackbar = new Snackbar();

  try {
    const ajax = new Ajax();
    const { authentication } = ApiRoutes;

    return await ajax.post(authentication.social, payload);
  } catch (error) {
    snackbar.show(
      "failed",
      "Aconteceu algo errado com a camada service de PostSocialAuth"
    );
  }
}
