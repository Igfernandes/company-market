<?php

namespace App\Api\Operations\Users\Groups\Post;

use App\Business\Permissions\PermissionsBusiness;
use App\Database\Entities\Permissions\GroupPermissionsEntity;
use App\Database\Entities\Users\GroupEntity;
use App\Database\Models\Permissions\GroupsPermissionsModel;
use App\Database\Models\Users\GroupsModel;
use App\Libraries\Exceptions\Exceptions;

class PostUseCases
{
    /**
     * @param array{
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

        if (!$permissionsBusiness->hasPermissionsAvailable($payload['permissions']))
            throw new Exceptions("Api.users.groups.invalid.not_found_permission", \BAD_BUSINESS_RULES);

        $groupEntity->store($payload);
        $groupEntity->setStatus("ACTIVE");

        $groupsModel->upsert($groupEntity->toArray(), $groupEntity);

        $groupsPermissionsModel = new GroupsPermissionsModel();
        $groupPermissionEntity = new GroupPermissionsEntity();

        $groupPermissionEntity->setGroupId($groupsModel->getInsertID());

        $permissionsBusiness->store($payload['permissions'], $groupPermissionEntity, $groupsPermissionsModel);

        return (object)[
            "success" => "Api.users.groups.success.post"
        ];
    }
}
