import { Snackbar } from "../../../components/snackbar/index.js";
import { Google } from "./index.js";
import { locations } from "./locations.js";

export const init = () => {
  const snackbar = new Snackbar();
  const { btnGoogle } = locations;
  const google = new Google();

  btnGoogle.addEventListener("click", async () => {
    try {
      await auth2.grantOfflineAccess().then(google.handle);
    } catch (err) {
      snackbar.show(
        "failed",
        "Ocorreu um problema com o login social, tente conectar-se com os outros métodos."
      );
      console.log(err);
    }
  });
};
