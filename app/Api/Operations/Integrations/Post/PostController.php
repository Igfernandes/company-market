<?php

namespace App\Api\Operations\Integrations\Post;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Business\Permissions\PermissionsValidationBusiness;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\ControllersTrait;
use CodeIgniter\HTTP\Response;
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
            PermissionsValidationBusiness::hasPermissionUserAuth([
                'scope' => 'integrations',
                'type' => 'UPDATE'
            ]);
            $validation = \Config\Services::validation();

            $allPayload = $this->request->getJSON() ?? [];
            $payload = array_intersect_key((array)$allPayload, array_flip(array_keys($this->rules)));

            $validation->setRules($this->rules);

            if (!$validation->run($payload))
                throw new Exceptions($validation->getErrors(), Response::HTTP_BAD_REQUEST);

            $responsePost = $this->postUseCases->execute((array) $allPayload);

            return $this->response->setJSON($responsePost)->setStatusCode(Response::HTTP_OK);
        } catch (Exception | Exceptions $err) {
            \var_dump($err);
            return  $this->response->setJSON((object)[
                "error" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
