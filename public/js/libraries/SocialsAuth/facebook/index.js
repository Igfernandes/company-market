import { Snackbar } from "../../../components/snackbar/index.js";
import { postSocialAuth } from "../../../services/SocialAuth/post.js";

export function Facebook() {
  this.handle = () => {
    const snackbar = new Snackbar();

    FB.login(
      function (response) {
        if (response.authResponse) {
          FB.api(
            "/me",
            { fields: "name, email, picture, birthday, hometown" },
            async function (data) {
              const { data: response } = await postSocialAuth({
                type: "FACEBOOK",
                external_id: data.id,
                email: data.email,
                name: data.name,
                photo: data.picture.data.url,
              });

              if (response.error) snackbar.show("failed", response.error);

              let redirectRoute = "/register";
              if (response.hasAccount === true) redirectRoute = "/panel";

              window.location.href = redirectRoute;
            }
          );
        } else {
          // If you are not logged in, the login dialog will open for you to login asking for permission to get your public profile and email
          console.log(
            "Ocorreu um problema com o login social, tente conectar-se com os outros métodos."
          );
        }
      },
      { scope: "public_profile, email" }
    );
  };
}
