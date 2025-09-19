<?php

namespace App\Api\Operations\Users\Roles\Permissions\Post;

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

    public function handle(int $id = 0)
    {
        try {
            PermissionsBusiness::hasPermissionUserAuth([
                'scope' => 'users',
                'type' => 'VIEW'
            ]);
            $validation = \Config\Services::validation();

            $payload = (array)$this->request->getJSON();
            $validation->setRules($this->rules);

            if (!isset($payload['ids']) || !is_array($payload['ids']))
                throw new Exceptions("Api.roles.invalid.permissions", BAD_REQUEST);

            if ($id <= 0)
                throw new Exceptions("Api.roles.invalid.id", BAD_REQUEST);

            $payload['role_id'] = $id;

            if (!$validation->run($payload))
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
