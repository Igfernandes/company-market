<?php

namespace App\Api\Operations\Users\Roles\Post;

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
        helper('crypto');
    }

    public function handle()
    {
        try {
            PermissionsBusiness::hasPermissionUserAuth([
                'scope' => 'users',
                'type' => 'VIEW'
            ]);
            $validation = \Config\Services::validation();

            $payload = $this->request->getJSON();
            $validation->setRules($this->rules);

            if (isset($payload->permissions) && !is_array($payload->permissions))
                throw new Exceptions("Api.roles.invalid.permissions", BAD_REQUEST);

            if (!$validation->run((array)$payload))
                throw new Exceptions($validation->getErrors(), BAD_REQUEST);

            $responsePost = $this->postUseCases->execute($payload);

            return $this->response->setJSON($responsePost)->setStatusCode(CREATED);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "error" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
