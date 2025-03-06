<?php

namespace App\Libraries\Exceptions;

use Exception;
use Throwable;

class Exceptions extends Exception
{
    protected array|Object|String $error;

    public function __construct(Object|array|String $message = "", int $code = 0, Throwable|null $previous = null)
    {
        $this->error = $message;

        parent::__construct(gettype($message) == "string" ? $message : json_encode($message), $code, $previous);
    }

    /**
     * @method getErrors function
     *
     * @return array|Object|String
     */
    public function getErrors(): array|Object|String
    {
        return $this->error;
    }
}
