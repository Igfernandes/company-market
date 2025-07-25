import { Snackbar } from "../../components/utils/snackbar/index.js";
import { Ajax } from "../../libraries/Ajax/index.js";
import { API_ROUTES } from "../../settings/api.js";

export async function postAuth(payload = {}) {
  const snackbar = new Snackbar();

  try {
    const ajax = new Ajax();
    const { auth } = API_ROUTES;

    const { data } = await ajax.post(auth, payload, {});

    if (data.errors)
      snackbar.show("failed", data.errors, {
        title: "Ocorreu um problema",
      });
    else {
      snackbar.show("success", "O usuário foi autenticado com sucesso", {
        title: "Autenticado",
      });
    }

    return data;
  } catch (error) {
    snackbar.show(
      "failed",
      "Aconteceu algo errado com a camada service de PostSocialAuth"
    );
  }
}
