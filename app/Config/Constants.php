<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2592000);
defined('YEAR')   || define('YEAR', 31536000);
defined('DECADE') || define('DECADE', 315360000);

/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*
 |--------------------------------------------------------------------------
 | Code responses Constants
 |--------------------------------------------------------------------------
 |
 | The code responses of project.
 */

define("OK", 200);
define("CREATED", 201);
define("ACCEPTED", 202);
define("NO_CONTENT", 204);
define("BAD_REQUEST", 400);
define("BAD_AUTH", 401);
define("FORBIDDEN_ERROR", 403);
define("NOT_FOUND", 404);
define("BAD_BUSINESS_RULES", 406);
define("INTERNAL_ERROR", 500);

/*
 |--------------------------------------------------------------------------
 | Routes Constants
 |--------------------------------------------------------------------------
 |
 | The routes of project.
 */
define("ROUTE_RESTORE", "/restore");
define("ROUTE_LOGOUT", "/load/auth/logout");
define("ROUTE_ACCESS", "/acesso");

/*
 |--------------------------------------------------------------------------
 | Views paths Constants
 |--------------------------------------------------------------------------
 |
 | The Views paths of project.
 */
define("VIEW_HEADER", "globals/_header");
define("VIEW_FOOTER", "globals/_footer");


/*
 |--------------------------------------------------------------------------
 | Regex Constants
 |--------------------------------------------------------------------------
 |
 | The Views paths of project.
 */
define("VALIDATE_EMAIL", "/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.]+\.[A-Za-z0-9_\-\.])/");
define("VALIDATE_TOKEN", "/\w{2}\-\w{2}\-\w{2}$/");
define("VALIDATE_PASSWORD", "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/");
define("VALIDATE_CPF_CNPJ", "/([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})/");
define("VALIDATE_PHONE", "/^([(][1-9]{2}[)] )?[0-9]{4}[-]?[0-9]{4}$/");
define("VALIDATE_CEP", "/(^\d{5}\x2D\d{3}$)/");

/*
 |--------------------------------------------------------------------------
 | OTHERS Constants
 |--------------------------------------------------------------------------
 |
 | The CONSTANTS of project.
 */
define("BASE_URL", getenv('CI_ENVIRONMENT') === 'production' ? getenv('globals.href.backend') : 'http://localhost:3000');

define("ATTEMPT_CHANCES", 3);
// CONTACTS AND SOCIAL MEDIAS

define("BASE_NUMERIC_REGISTRATIONS", 100000);
define("DAY_AT_SECONDS", 86400);
define("WEEKDAYS", [
    "SUNDAY"    => 0,
    "MONDAY"    => 1,
    "TUESDAY"   => 2,
    "WEDNESDAY" => 3,
    "THURSDAY"  => 4,
    "FRIDAY"    => 5,
    "SATURDAY"  => 6,
]);
