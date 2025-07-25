export const exportsExternal = {
  "/": [
    /** HELPERS */
    "/js/helpers/toggleTypePassword.js",

    "/js/libs/SocialsAuth/google/init.js",
    "/js/libs/SocialsAuth/facebook/init.js",
    /** MODULES - OTHERS */
    "/js/modules/Others/Password/Visibility/init.js",
  ],
  "/register": [
    "/js/modules/Others/TradeScenes/init.js",
    "/js/modules/Register/init.js",

    /** HELPERS */
    "/js/helpers/collapse.js",
    "/js/helpers/toggleTypePassword.js",

    /** MODULES - OTHERS */
    "/js/modules/Others/Password/Visibility/init.js",
    "/js/modules/Others/PasswordCriterion/init.js",
    "/js/modules/Others/Files/init.js",
    "/js/modules/Others/EnableFields/init.js",
    "/js/modules/Others/AddArchive/init.js",
    "/js/modules/Others/Validators/init.js",
    "/js/modules/Others/Address/init.js",
    "/js/modules/Others/Collapse/init.js",
    "/js/modules/Others/ClearUrl/init.js",
    "/js/modules/Others/ConfirmEmail/init.js",
    "/js/libs/Mask/index.js",
  ],
  "/recover/password": ["/js/modules/Recover/Password/Request/init.js"],
  "/recover/password/confirmation/*": [
    /** HELPERS */
    "/js/helpers/toggleTypePassword.js",

    /** MODULES - RECOVER */
    "/js/modules/Recover/Password/Confirm/init.js",
    "/js/modules/Confirmation/PatchEmailConfirmation/init.js",

    /** MODULES - OTHERS */
    "/js/modules/Others/Password/Visibility/init.js",
    "/js/modules/Others/PasswordCriterion/init.js",
    "/js/modules/Others/IncorrectFields/init.js",
    "/js/modules/Others/Password/Visibility/init.js",
  ]
};
