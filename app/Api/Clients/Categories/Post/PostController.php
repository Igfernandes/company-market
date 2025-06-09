<?php

namespace App\Api\Clients\Categories\Post;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Business\Permissions\PermissionsBusiness;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\ControllersTrait;
use Exception;

class PostController extends BaseController
{
    use Validation, ExceptionApi, PostDTOs, ControllersTrait;

    private PostUseCases $postUseCases;

    public function __construct()
    {
        $this->postUseCases = new PostUseCases();
    }

    public function handle()
    {
        try {
            PermissionsBusiness::hasPermissionUserAuth([
                'scope' => 'categories',
                'type' => 'CREATE'
            ]);

            $validation = \Config\Services::validation();

            $payload = (array) $this->request->getVar();
            $payloadVerify["categories"] =  \json_encode($payload["categories"]);
            $validation->setRules($this->rules);

            if (!$validation->run($payloadVerify))
                throw new Exceptions($validation->getErrors(), BAD_REQUEST);

            $responsePost = $this->postUseCases->execute($payload);

            return $this->response->setJSON($responsePost)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "errors" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
