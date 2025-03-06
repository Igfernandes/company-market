<?php

namespace App\Api;

use App\Libraries\Exceptions\Exceptions;
use Exception;

trait ExceptionApi
{
    protected function getMessageError(Exceptions|Exception $err)
    {
        if (getenv("CI_ENVIRONMENT") == 'development' && $err->getCode() < BAD_REQUEST || $err->getCode() >= INTERNAL_ERROR)
            return var_dump($err);

        if ($err instanceof Exceptions  && !empty($err->getErrors()))
            $message = $err->getErrors();
        else $message = $err->getMessage();

        return !empty($message) ? $message : 'Did something wrong happen';
    }

    protected function getCodeError($err)
    {
        return $err->getCode() >= BAD_REQUEST && $err->getCode() <= INTERNAL_ERROR ? $err->getCode() : INTERNAL_ERROR;
    }
}
