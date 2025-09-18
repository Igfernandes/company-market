<?php

namespace App\Traits\Users;

use App\Database\Entities\Permissions\PermissionEntity;

trait PermissionsDataTrait
{
    /**
     * @param PermissionEntity $roleEntity
     */
    public function builder(PermissionEntity $permissionEntity): Object
    {
        return  (object)[
            "id" => $permissionEntity->getId(),
            "name" => $permissionEntity->getName(),
            "type" => $permissionEntity->getType(),
            "scope" => $permissionEntity->getScope()
        ];
    }
}
