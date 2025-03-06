<?php

namespace App\Helpers;

use Exception;

class ExceptionsRules
{
    static function internalError(Exception $err)
    {
        $session = session();
        $LANGUAGE = $session->get("language");

        if (($err->getCode() > 500 || $err->getCode() < 400)  && getenv('CI_ENVIRONMENT') == "development")
            dd($err);

        return $err->getCode() == 500 ? lang('Errors.default_error', [], $LANGUAGE) : $err->getMessage();
    }
}
