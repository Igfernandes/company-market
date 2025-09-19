<?php

namespace App\Api\Operations\Users\Roles\Post;

use App\Business\Permissions\PermissionsBusiness;
use App\Database\Entities\Users\RoleEntity;
use App\Database\Models\Permissions\RolesPermissionsModel;
use App\Database\Models\Users\RolesModel;
use App\Libraries\Exceptions\Exceptions;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class PostUseCases
{
    /**
     * @param object{
     *   name: string,
     *   description: string
     * } $payload
     */
    public function execute(object $payload)
    {
        $roleEntity = new RoleEntity();
        $roleEntity->store((array)$payload);
        $permissionsBusiness = new PermissionsBusiness();
        $hasPermissionsAvailable = 0;
        
        if (isset($payload->permissions)) {
            $hasPermissionsAvailable = is_array($payload->permissions) && count($payload->permissions) > 0;

            if ($hasPermissionsAvailable && !$permissionsBusiness->hasPermissionsAvailable($payload->permissions))
                throw new Exceptions("Api.permissions.invalid.in_ids", ResponseInterface::HTTP_NOT_ACCEPTABLE);
        }
        $rolesModel = new RolesModel();
        $foundRole = $rolesModel->where("name", $payload->name)->first();

        if (!empty($foundRole))
            throw new Exception("Api.roles.invalid.already_exists",  ResponseInterface::HTTP_NOT_ACCEPTABLE);

        $roleEntity->setStatus("ACTIVE");
        $rolesModel->save($roleEntity);
        $roleId = $rolesModel->getInsertID();

        if ($hasPermissionsAvailable) {
            $permissions = \array_map(fn(int $permissionId) => [
                "role_id" => $roleId,
                "permission_id" => $permissionId
            ], $payload->permissions);

            $rolesPermissionsModel = new RolesPermissionsModel();
            $rolesPermissionsModel->insertBatch($permissions);
        }

        // NotificationsService::store([
        //     "scope" => "roles",
        //     "action" => "CREATE"
        // ]);

        return (object)[
            "success" => "Api.roles.success.post"
        ];
    }
}
