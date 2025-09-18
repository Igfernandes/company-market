import { ajax } from "../../../../libraries/Ajax/index.js";
import { translate } from "../../../../translate/index.js";
import { ModalsModule } from "../modal/exports.js";
import { snackbar } from "../snackbar.js";
import { PERMISSION_MODAL_ID } from "./core/constants.js";
import { getPermissions } from "./core/targets.js";

export function Permissions() {
  this.handle = async () => {
    const btn = ModalsModule.getRightButton(PERMISSION_MODAL_ID);
    const api = btn.getAttribute("permission-api");
    const key = btn.getAttribute("permission-key");

    if (!api || !key) {
      return ModalsModule.close(PERMISSION_MODAL_ID);
    }

    const response = await ajax.post(
      api,
      JSON.stringify({
        key,
        ids: getPermissions(),
      })
    );

    if (!!response.data.error)
      return snackbar.execute("NOTICE", {
        title: translate("Words.permissions"),
        message: translate("Screens.default.service_error"),
      });

    ModalsModule.close(PERMISSION_MODAL_ID);
    snackbar.execute("SUCCESS", {
      title: translate("Words.permissions"),
      message: translate(response.data.success),
    });
  };
}
