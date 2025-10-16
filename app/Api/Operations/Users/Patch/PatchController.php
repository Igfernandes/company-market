<?php

namespace App\Api\Operations\Users\Patch;

use App\Api\ExceptionApi;
use App\Api\Operations\Users\Patch\Avatar\PatchAvatarUseCases;
use App\Api\Operations\Users\Patch\Password\PatchPasswordUseCases;
use App\Api\Operations\Users\Patch\Status\PatchStatusUseCases;
use App\Api\Validation;
use App\Business\Permissions\PermissionsValidationBusiness;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\ControllersTrait;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class PatchController extends BaseController
{
    use Validation, ExceptionApi, ControllersTrait, PatchDTOs;

    private array $operations;

    public function __construct()
    {
        $this->operations = [
            "status" => new PatchStatusUseCases(),
            "password" => new PatchPasswordUseCases(),
            "avatar" => new PatchAvatarUseCases(),
        ];
    }

    public function handle(int $userId = 0)
    {
        try {
            PermissionsValidationBusiness::hasPermissionUserAuth([
                'scope' => 'users',
                'type' => 'UPDATE'
            ]);
            $payload = (array) $this->request->getJSON();

            if (!isset($payload['operation']))
                throw new Exception("Api.not_found", ResponseInterface::HTTP_BAD_GATEWAY);

            $operation = $payload['operation'];
            $validation = \Config\Services::validation();

            $data = isset($payload['data']) ? $payload['data'] : (object)[];
            $data->id = $userId;

            $validation->setRules($this->rules);

            if (!$validation->run($payload))
                throw new Exceptions($validation->getErrors(), BAD_REQUEST);

            if (!isset($this->operations[$operation]))
                throw new Exceptions("Api.users.invalid.operation", \NOT_FOUND);

            $responsePatch = $this->operations[$operation]->execute((array)$data);

            return $this->response->setJSON($responsePatch)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "error" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
