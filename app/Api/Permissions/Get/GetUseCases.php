<?php

namespace App\Api\Permissions\Get;

use App\Database\Entities\Permissions\PermissionEntity;
use App\Database\Models\Permissions\PermissionsModel;
use App\Traits\BusinessTrait;

class GetUseCases
{
    use BusinessTrait;

    /**
     * @param array{ 
     *     id: int,
     *     in_ids: array<int>, 
     *     name: string, 
     *     type: string,
     *     scope: string
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $permissionsModel = new PermissionsModel();
        $permissionEntity = new PermissionEntity();

        $in_ids = isset($filteredPayload['in_ids']) ? $filteredPayload['in_ids'] : [];
        unset($filteredPayload['in_ids']);

        $permissionsModel = $this->builderClauseWithContains($filteredPayload ?? [], $permissionsModel);

        if (count($in_ids) > 0)
            $permissionsModel->whereIn("id", $in_ids);

        $permissionEntity->fill($filteredPayload);
        /** @var array{CategoryEntity}*/
        $foundPermissions = $permissionsModel->where($filteredPayload)->findAll();

        return array_map(fn(PermissionEntity $permission) => $permission->toArray(), $foundPermissions);
    }
}
