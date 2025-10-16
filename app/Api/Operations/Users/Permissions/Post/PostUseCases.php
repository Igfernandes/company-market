<?php

namespace App\Api\Operations\Users\Permissions\Post;

use App\Database\Models\Permissions\UsersPermissionsModel;

class PostUseCases
{
    /**
     * @param array{
     *   user_id: integer,
     *   permissions: array
     * } $payload
     */
    public function execute(array $payload)
    {
        $usersPermissionsModel = new UsersPermissionsModel();
        $usersPermissionsModel->where("user_id", $payload['user_id'])->delete();

        $permissions = \array_map(fn(int $permissionId) => [
            "user_id" => $payload['user_id'],
            "permission_id" => $permissionId
        ], $payload['permissions']);

        if (count($permissions) > 0)
            $usersPermissionsModel->insertBatch($permissions);

        return (object)[
            "success" => "Api.users.permissions.success.post"
        ];
    }
}
