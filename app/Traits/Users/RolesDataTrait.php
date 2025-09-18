<?php

namespace App\Traits\Users;

use App\Database\Entities\Users\RoleEntity;
use App\Database\Entities\Users\UserGroupsEntity;
use App\Database\Entities\Users\UserRoleEntity;

trait RolesDataTrait
{
    /**
     * 
     * @param RoleEntity $roleEntity
     * @param array{UserRoleEntity} $userRoleEntities
     */
    public function builder(RoleEntity $roleEntity, array $userRoleEntities): Object
    {
        $rolesFiltered = \array_filter(
            $userRoleEntities,
            fn(UserRoleEntity $userRoleEntity) => $userRoleEntity->getRoleId() == $roleEntity->getId()
        );

        return  (object)[
            "id" => $roleEntity->getId(),
            "name" => $roleEntity->getName(),
            "description" => $roleEntity->getDescription(),
            "users" => count($rolesFiltered),
            "status" => $roleEntity->getStatus(),
            "created_at" => $roleEntity->getCreatedAt(),
            "updated_at" => $roleEntity->getUpdatedAt()
        ];
    }
}
