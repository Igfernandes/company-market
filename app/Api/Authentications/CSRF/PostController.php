<?php

namespace App\Api\Authentications\CSRF;

use App\Api\Authentications\Auth\PostDTOs;
use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use Exception;

class PostController extends BaseController
{
    use Validation, ExceptionApi, PostDTOs;

    public function handle()
    {
        try {
            return $this->response->setJSON([
                'csrf_token' => csrf_token(),
                'csrf_hash' => csrf_hash()
            ])->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "errors" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
