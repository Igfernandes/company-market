<?php

namespace App\Api\Operations\Authentications\RememberMe;

use App\Api\Operations\Authentications\RememberMe\PostDTOs;
use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use Exception;

class PostController extends BaseController
{
    use Validation, ExceptionApi, PostDTOs;

    private PostUseCases $postUseCases;

    public function __construct()
    {
        $this->postUseCases = new PostUseCases();
    }

    public function handle()
    {
        try {
            $request = service('request');

            $payload = $this->getPayload();

            $browser = $request->getUserAgent()->getBrowser();
            $responsePost = $this->postUseCases->execute($payload, (object)[
                "ip" => $request->getIPAddress() ?? "127.0.0.1",
                "browser" => !empty($browser) ? $browser : "Postman"
            ]);

            return $this->response->setJSON($responsePost)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "errors" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
