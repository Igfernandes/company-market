<?php

namespace App\Api\Operations\Users\Roles\Permissions\Post;

use App\Database\Models\Permissions\RolesPermissionsModel;

class PostUseCases
{
    /**
     * @param array{
     *   role_id: integer,
     *   ids: array
     * } $payload
     */
    public function execute(array $payload)
    {
        $rolesPermissionsModel = new RolesPermissionsModel();
        $rolesPermissionsModel->where("role_id", $payload['role_id'])->delete();

        $permissions = \array_map(fn(int $permissionId) => [
            "role_id" => $payload['role_id'],
            "permission_id" => $permissionId
        ], $payload['ids']);

        $rolesPermissionsModel->insertBatch($permissions);

        return (object)[
            "success" => "Api.roles.permissions.success.post"
        ];
    }
}
