import { Snackbar } from "../../../components/snackbar/index.js";
import { postSocialAuth } from "../../../services/SocialAuth/post.js";

export function Google() {
  this.handle = async function (authResult) {
    const snackbar = new Snackbar();

    if (authResult["code"]) {
      if (auth2.isSignedIn.get()) {
        const profile = await auth2.currentUser.get().getBasicProfile();

        const { data: response } = await postSocialAuth({
          external_id: profile.getId(),
          name: profile.getName(),
          photo: profile.getImageUrl(),
          email: profile.getEmail(),
          type: "GOOGLE",
        });

        if (response.error) snackbar.show("failed", response.error);

        let redirectRoute = "/register";
        if (response.hasAccount === true) redirectRoute = "/panel";

        window.location.href = redirectRoute;
      }
    } else {
      snackbar.show(
        "failed",
        "Ocorreu um problema com o login social, tente conectar-se com os outros métodos."
      );
    }
  };
}
