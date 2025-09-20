<?php

namespace App\Api\Operations\Users\Roles\Delete;

use App\Business\Users\Roles\RolesBusiness;
use App\Database\Models\Users\RolesModel;
use App\Libraries\Exceptions\Exceptions;
use CodeIgniter\HTTP\ResponseInterface;

class DeleteUseCases
{
    /**
     * @param array{
     *   id: int
     * } $payload
     */
    public function execute(array $payload)
    {
        $rolesModel = new RolesModel();

        $roleId = $payload['id'];

        $found = $rolesModel->where([
            "id" => $roleId
        ])->first();

        if (strtolower($found->getName()) === "administrator")
            throw new Exceptions("Api.roles.invalid.not_permit", ResponseInterface::HTTP_NOT_ACCEPTABLE);

        if (empty($found))
            throw new Exceptions("Api.roles.invalid.not_found", ResponseInterface::HTTP_NOT_ACCEPTABLE);

        if (RolesBusiness::hasUsers(0, $roleId))
            throw new Exceptions("Api.roles.invalid.has_users", ResponseInterface::HTTP_NOT_ACCEPTABLE);

        $rolesModel->delete($roleId);

        // NotificationsService::store([
        //     "scope" => "roles",
        //     "action" => "DELETE"
        // ]);
        return (object)[
            "success" => "Api.roles.success.delete"
        ];
    }
}
