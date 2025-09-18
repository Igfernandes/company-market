<?php

namespace App\Api\Operations\Users\Roles\Delete;

use App\Business\Users\Roles\RolesBusiness;
use App\Database\Models\Users\RolesModel;
use App\Libraries\Exceptions\Exceptions;

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

        if (empty($found))
            throw new Exceptions("Api.users.invalid.not_found", \BAD_BUSINESS_RULES);

        if (RolesBusiness::hasUsers(0, $roleId))
            throw new Exceptions("Api.roles.invalid.has_users", \BAD_BUSINESS_RULES);

        $rolesModel->delete($roleId);

        // NotificationsService::store([
        //     "scope" => "roles",
        //     "action" => "DELETE"
        // ]);
        return (object)[
            "success" => "Api.users.roles.success.delete"
        ];
    }
}
