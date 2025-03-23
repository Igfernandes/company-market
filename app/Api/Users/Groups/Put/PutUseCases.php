<?php

namespace App\Api\Users\Groups\Put;

use App\Business\Permissions\PermissionsBusiness;
use App\Business\Users\Groups\GroupsBusiness;
use App\Database\Entities\Permissions\GroupPermissionsEntity;
use App\Database\Entities\Users\GroupEntity;
use App\Database\Models\Permissions\GroupsPermissionsModel;
use App\Database\Models\Users\GroupsModel;
use App\Libraries\Exceptions\Exceptions;

class PutUseCases
{
    /**
     * @param array{
     *   id: int,
     *   name: string,
     *   description: string|null,
     *   permissions: array{Int}
     * } $payload
     */
    public function execute(array $payload)
    {
        $groupsModel = new GroupsModel();
        $groupEntity = new GroupEntity();
        $permissionsBusiness = new PermissionsBusiness();
        $groupsBusiness = new GroupsBusiness();

        $groupId = $payload['id'];
        unset($payload['id']);

        if (!$groupsBusiness->hasClub([
            "id" => $groupId
        ]))
            throw new Exceptions(\str_replace("{field}", "permissions", lang("Validation.not_found")), \BAD_BUSINESS_RULES);

        if (!$permissionsBusiness->hasPermissions($payload['permissions']))
            throw new Exceptions(\str_replace("{field}", "permissions", lang("Validation.invalid_list")), \BAD_BUSINESS_RULES);

        $groupEntity->setStore($payload);
        $groupEntity->setStatus("ACTIVE");

        $groupsModel->update($groupId, $groupEntity);

        $groupsPermissionsModel = new GroupsPermissionsModel();
        $groupPermissionEntity = new GroupPermissionsEntity();

        $groupPermissionEntity->setGroupId($groupId);

        $permissionsBusiness->store($payload['permissions'], $groupPermissionEntity, $groupsPermissionsModel);

        return (object)[
            "success" => lang("Api.groups.success.put")
        ];
    }
}
