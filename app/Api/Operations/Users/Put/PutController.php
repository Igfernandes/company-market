<?php

namespace App\Api\Operations\Users\Put;

use App\Api\ExceptionApi;
use App\Api\Validation;
use App\Business\Permissions\PermissionsValidationBusiness;
use App\Controllers\BaseController;
use App\Database\Entities\Users\UserEntity;
use App\Libraries\Exceptions\Exceptions;
use Exception;

class PutController extends BaseController
{
    use Validation, ExceptionApi, PutDTOs;

    private PutUseCases $putUseCases;

    public function __construct()
    {
        $this->putUseCases = new PutUseCases();
        helper('crypto');
    }

    public function handle(int $userId = 0)
    {
        try {
            PermissionsValidationBusiness::hasPermissionUserAuth([
                'scope' => 'users',
                'type' => 'UPDATE'
            ]);
            $validation = \Config\Services::validation();

            $allPayload = $this->request->getJSON() ?? [];
            $payload = array_intersect_key((array)$allPayload, array_flip(array_keys($this->rules)));

            $session = \session();
            /** @var UserEntity $userAuth */
            $userAuth = $session->get(SESSION_KEY_AUTH_USER);

            if ($userId  > 0 || !empty($userId)) {
                $payload['id'] = $userId;
            } else
                $payload['id'] = $userAuth->getId();

            $validation->setRules($this->rules);

            if (!$validation->run($payload))
                throw new Exceptions($validation->getErrors(), BAD_REQUEST);

            $responsePut = $this->putUseCases->execute($payload);

            return $this->response->setJSON($responsePut)->setStatusCode(OK);
        } catch (Exception | Exceptions $err) {

            return  $this->response->setJSON((object)[
                "error" => $this->getMessageError($err)
            ])->setStatusCode($this->getCodeError($err));
        }
    }
}
