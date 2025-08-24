<?php

namespace App\Api\Operations\Exports\Post;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Business\Permissions\PermissionsBusiness;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\ControllersTrait;
use CodeIgniter\HTTP\ResponseInterface;
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
            $validation = \Config\Services::validation();

            $payload = $this->request->getJSON(true);
            $validation->setRules($this->rules);

            if (!$validation->run($payload))
                throw new Exceptions($validation->getErrors(), ResponseInterface::HTTP_BAD_REQUEST);

            if (isset($payload['in_ids']) && !is_array($payload['in_ids']))
                throw new Exceptions("Api.exports.invalid.in_ids", ResponseInterface::HTTP_BAD_REQUEST);
            else $payload['in_ids'] = [];

            $isIdInvalid = \array_filter($payload['in_ids'], fn($id) => \gettype($id) !== "integer");

            if (\count($isIdInvalid) > 0 && count($payload['in_ids']) > 0)
                throw new Exceptions("Api.exports.invalid.in_ids", ResponseInterface::HTTP_BAD_REQUEST);

            $responsePost = $this->postUseCases->execute($payload);

            return $this->response->setJSON($responsePost)->setStatusCode(ResponseInterface::HTTP_OK);
        } catch (Exception | Exceptions $err) {
         
            return  $this->response->setJSON((object)[
                "error" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
