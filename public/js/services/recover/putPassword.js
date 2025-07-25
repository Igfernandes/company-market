import { Snackbar } from "../../components/utils/snackbar/index.js";
import { formDataToJson } from "../../helpers/payload.js";
import { Ajax } from "../../libraries/Ajax/index.js";
import { API_ROUTES } from "../../settings/api.js";

export async function putRecoverPassword(payload = {}) {
  const snackbar = new Snackbar();

  try {
    const ajax = new Ajax();
    const { recover } = API_ROUTES;

    const { data } = await ajax.custom(
      recover.password,
      formDataToJson(payload),
      {
        method: "put",
        headers: {
          "Content-Type": "application/json",
        },
      }
    );

    if (data.errors)
      snackbar.show("failed", data.errors, {
        title: "Fala no envio",
      });
    else {
      snackbar.show(
        "success",
        "Abra a sua caixa de e-mail e siga as instruções",
        {
          title: "Token Enviado",
        }
      );
    }

    return data;
  } catch (error) {
    snackbar.show(
      "failed",
      "Aconteceu algo errado com a camada service de PostSocialAuth"
    );
  }
}
