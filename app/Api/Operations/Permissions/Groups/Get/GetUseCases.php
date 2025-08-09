<?php

namespace App\Api\Operations\Permissions\Groups\Get;

use App\Database\Entities\Permissions\GroupPermissionsEntity;
use App\Database\Models\Permissions\GroupsPermissionsModel;
use App\Traits\BusinessTrait;

class GetUseCases
{
    use BusinessTrait;

    /**
     * @param array{ 
     *     id: int,
     *     in_ids: array<int>
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $groupPermissionsModel = new GroupsPermissionsModel();

        $foundGroupsPermission = $groupPermissionsModel->getGroupsWithPermissions($filteredPayload);
        $groups = [];

        /** @var GroupPermissionsEntity */
        foreach ($foundGroupsPermission as $groupPermission) {
            if (!isset($groups[$groupPermission->getGroupId()])) {
                $groups[$groupPermission->getGroupId()] = $groupPermission->getGroup()->toArray();
                $groups[$groupPermission->getGroupId()]["permissions"] = [];
            }

            \array_push($groups[$groupPermission->getGroupId()]["permissions"], (object)[
                "id" => $groupPermission->getPermission()->getId(),
                "name" => $groupPermission->getPermission()->getName()
            ]);
        }

        return array_values($groups);
    }
}
