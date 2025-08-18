<?php

namespace App\Api;

use App\Libraries\Exceptions\Exceptions;
use Exception;

trait ExceptionApi
{
    protected function getMessageError(Exceptions|Exception $err)
    {
        helper('objects');

        if (getenv("CI_ENVIRONMENT") === 'development' && (!$err->getCode() || $err->getCode() >= INTERNAL_ERROR)) {
            // dump apenas para debug, mas sem quebrar execução
            error_log($err);
            return $err->getMessage();
        }

        if ($err instanceof Exceptions  && !empty($err->getErrors()))
            $message = is_array($err->getErrors()) ? array_values($err->getErrors())[0] : $err->getErrors();
        else $message = $err->getMessage();

        return !empty($message) ? $message : 'Did something wrong happen';
    }

    protected function getCodeError($err)
    {
        return $err->getCode() >= ACCEPTED && $err->getCode() <= INTERNAL_ERROR ? $err->getCode() : INTERNAL_ERROR;
    }
}
