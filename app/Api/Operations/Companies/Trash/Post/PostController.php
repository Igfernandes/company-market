<?php

namespace App\Api\Operations\Companies\Trash\Post;

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
    use Validation, ExceptionApi, ControllersTrait, PostDTOs;

    private PostUseCases $postUseCases;

    public function __construct()
    {
        $this->postUseCases = new PostUseCases();
    }

    public function handle()
    {
        try {
            PermissionsValidationBusiness::hasPermissionUserAuth([
                'scope' => 'companies',
                'type' => 'UPDATE'
            ]);
            $validation = \Config\Services::validation();

            $payload = (array)$this->request->getJSON();
            $validation->setRules($this->rules);

            if (!$validation->run($payload))
                throw new Exceptions($validation->getErrors(), Response::HTTP_BAD_REQUEST);

            $responseDelete = $this->postUseCases->execute($payload);

            return $this->response->setJSON($responseDelete)->setStatusCode(Response::HTTP_OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "error" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
