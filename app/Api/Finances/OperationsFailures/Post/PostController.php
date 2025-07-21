<?php

namespace App\Api\Finances\OperationsFailures\Post;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Business\Permissions\PermissionsBusiness;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\ControllersTrait;
use Exception;

class PostController extends BaseController
{
    use Validation, ExceptionApi, ControllersTrait;

    private PostUseCases $postUseCases;

    public function __construct()
    {
        $this->postUseCases = new PostUseCases();
    }

    public function handle(int $operationId)
    {
        try {
            $responsePost = $this->postUseCases->execute([
                "id" => $operationId
            ]);

            return $this->response->setJSON($responsePost)->setStatusCode(CREATED);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "errors" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
