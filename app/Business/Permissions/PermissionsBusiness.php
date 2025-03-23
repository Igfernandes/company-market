<?php

namespace App\Business\Permissions;

use App\Business\BaseBusiness;
use App\Database\Models\Permissions\PermissionsModel;
use App\Interfaces\IPermissions;
use CodeIgniter\BaseModel;

class PermissionsBusiness
{
    use BaseBusiness;
    /**
     * @param array{Int} $permissions
     */
    public function hasPermissions($permissions): bool
    {
        $permissionsModel = new PermissionsModel();
        if (!is_array($permissions)) return false;

        $foundPermissions = $permissionsModel->whereIn("id", $permissions)->findAll();

        return count($foundPermissions) == count($permissions);
    }

    public function store(array $permissions, IPermissions $entity, BaseModel $model)
    {
        foreach ($permissions as $permission) {
            $entity->setPermissionId($permission);

            $model->upsert($entity->toArray(true), $entity);
        }
    }
}
