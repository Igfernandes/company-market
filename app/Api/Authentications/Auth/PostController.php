<?php

namespace App\Api\Authentications\Auth;

use App\Api\Authentications\Auth\PostDTOs;
use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use Exception;

class PostController extends BaseController
{
    use Validation, ExceptionApi, PostDTOs;

    private PostUseCases $postUseCases;
    protected $helpers = ['recaptcha', 'cache'];

    public function __construct()
    {
        $this->postUseCases = new PostUseCases();
    }

    public function handle()
    {
        try {
            $validation = \Config\Services::validation();
            $request = service('request');

            $payload = $this->request->getVar(array_keys($this->rules));
      
            $validation->setRules($this->rules);

            $payload['rememberMe'] = !isset($payload['rememberMe']) ? 0 : $payload['rememberMe'];

            if (!$validation->run($payload))
                throw new Exceptions($validation->getErrors(), BAD_REQUEST);

            $browser = $request->getUserAgent()->getBrowser();
            $responsePost = $this->postUseCases->execute($payload, (Object)[
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
