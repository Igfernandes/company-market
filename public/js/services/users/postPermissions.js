import { Snackbar } from "../../components/shared/utils/snackbar.js";
import { getParams } from "../../helpers/route.js";
import { ajax } from "../../libraries/Ajax/index.js";
import { API_ROUTES } from "../../settings/api.js";
import { translate } from "../../translate/index.js";

export async function postUsersPermissions({ userId, ...payload } = {}) {
  const snackbar = new Snackbar();
  const snackbarTitleText = translate(
    "Screens.users.permissions.snackbar_title"
  );

  try {
    const { users } = API_ROUTES;

    const { data } = await ajax.post(
      getParams(users.permissions, {
        userId: userId ?? "",
      }),
      JSON.stringify(payload)
    );

    if (data.error)
      return snackbar.execute("FAIL", {
        title: snackbarTitleText,
        message: translate(data.error),
      });

    snackbar.execute("SUCCESS", {
      title: snackbarTitleText,
      message: translate(data.success),
    });

    return data;
  } catch (error) {
    snackbar.execute("NOTICE", {
      title: snackbarTitleText,
      message: translate("Screens.default.service_error"),
    });
  }
}
