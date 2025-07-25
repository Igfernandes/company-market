import { Snackbar } from "../../components/snackbar/index.js";
import { Ajax } from "../../libs/Ajax/index.js";

export async function getDataAddress() {
  const snackbar = new Snackbar();

  try {
    const ajax = new Ajax();

    return await ajax.get(`${window.location.origin}/json/address/state.json`);
  } catch (error) {
    snackbar.show(
      "failed",
      "Aconteceu algo errado com a camada service de GetDataAddress"
    );
  }
}
