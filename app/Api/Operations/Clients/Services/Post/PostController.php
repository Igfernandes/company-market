<?php

namespace App\Api\Operations\Clients\Services\Post;

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
    protected $helpers = [''];

    public function __construct()
    {
        $this->postUseCases = new PostUseCases();
        helper('crypto');
    }

    public function handle(int $serviceId)
    {
        try {
            PermissionsBusiness::hasPermissionUserAuth([
                'scope' => 'services',
                'type' => 'UPDATE'
            ]);

            $payload = $this->request->getVar(array_keys($this->rules));
            $payload['service_id'] = $serviceId;
            
            $responsePost = $this->postUseCases->execute($payload);

            return $this->response->setJSON($responsePost)->setStatusCode(CREATED);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "error" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
