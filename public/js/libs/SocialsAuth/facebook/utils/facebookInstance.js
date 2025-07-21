export function facebookInstance() {
  (function (d, s, id) {
    var js,
      fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
      return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  })(document, "script", "facebook-jssdk");

  window.fbAsyncInit = function () {
    // Initialize the SDK with your app and the Graph API version for your app
    FB.init({
      appId: "890178875766148",
      xfbml: true,
      version: "v2.7",
    });
  };
}
