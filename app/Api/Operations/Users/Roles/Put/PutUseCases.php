<?php

namespace App\Api\Operations\Users\Roles\Put;

use App\Business\Users\Roles\RolesBusiness;
use App\Database\Entities\Users\RoleEntity;
use App\Database\Models\Users\RolesModel;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class PutUseCases
{
    /**
     * @param array{
     *   id: integer,
     *   name: string,
     *   description: string,
     * } $payload
     */
    public function execute(array $payload)
    {
        $roleEntity = new RoleEntity();
        $roleEntity->store($payload);

        $rolesModel = new RolesModel();
        $foundRole = $rolesModel->where("id", $payload['id'])->first();

        if (RolesBusiness::hasAvailableNameRole($payload['name'], $payload['id']))
            throw new Exception("Api.roles.invalid.already_exists_name",  ResponseInterface::HTTP_NOT_ACCEPTABLE);

        if (empty($foundRole))
            throw new Exception("Api.roles.invalid.id",  ResponseInterface::HTTP_NOT_ACCEPTABLE);

        if (count($roleEntity->toArray(true)) > 0)
            $rolesModel->set($roleEntity->toArray(true))->update($payload['id']);

        return (object)[
            "success" => "Api.roles.success.put"
        ];
    }
}
