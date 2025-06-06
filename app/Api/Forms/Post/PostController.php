<?php

namespace App\Api\Forms\Post;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use Exception;

class PostController extends BaseController
{
    use Validation, ExceptionApi;

    private PostUseCases $postUseCases;
    protected $helpers = ['recaptcha'];

    public function __construct()
    {
        $this->postUseCases = new PostUseCases();
    }

    public function handle()
    {
        try {

            $payload = $this->request->getVar();
            $payload['files'] = $this->request->getFiles();

            $responsePost = $this->postUseCases->execute($payload);

            return $this->response->setJSON($responsePost)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "errors" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
