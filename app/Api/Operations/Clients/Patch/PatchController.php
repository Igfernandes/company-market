<?php

namespace App\Api\Operations\Clients\Patch;

use App\Api\Operations\Clients\Patch\Category\PatchCategoryUseCases;
use App\Api\ExceptionApi;
use App\Api\Operations\Clients\Patch\Avatar\PatchAvatarUseCases;
use App\Api\Validation;
use App\Business\Permissions\PermissionsValidationBusiness;
use App\Controllers\BaseController;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\ControllersTrait;
use CodeIgniter\HTTP\Response;
use Exception;

class PatchController extends BaseController
{
    use Validation, ExceptionApi, PatchDTOs, ControllersTrait;

    private array $operations = [];
    public function __construct()
    {
        $this->operations = [
            "avatar" => new PatchAvatarUseCases(),
            "category" => new PatchCategoryUseCases()
        ];
    }

    public function handle(int $id = 0)
    {
        try {
            PermissionsValidationBusiness::hasPermissionUserAuth([
                'scope' => 'clients',
                'type' => 'UPDATE'
            ]);
            $payload = (array) $this->request->getJSON();

            if (!isset($payload['operation']))
                throw new Exception("Api.not_found", Response::HTTP_BAD_GATEWAY);

            $operation = $payload['operation'];
            $validation = \Config\Services::validation();

            $data = isset($payload['data']) ? $payload['data'] : (object)[];
            $data->id = $id;

            $validation->setRules($this->rules);

            if (!$validation->run($payload))
                throw new Exceptions($validation->getErrors(), Response::HTTP_BAD_REQUEST);

            if (!isset($this->operations[$operation]))
                throw new Exceptions("Api.users.invalid.operation", Response::HTTP_NOT_FOUND);

            $responsePatch = $this->operations[$operation]->execute((array)$data);

            return $this->response->setJSON($responsePatch)->setStatusCode(Response::HTTP_OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "error" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
