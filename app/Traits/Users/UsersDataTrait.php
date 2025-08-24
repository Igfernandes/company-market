<?php

namespace App\Traits\Users;

use App\Database\Entities\Users\UserEntity;
use App\Database\Entities\Users\UserGroupsEntity;
use App\Database\Entities\Users\UserRoleEntity;

trait UsersDataTrait
{
    /**
     * 
     * @param UserEntity $userEntity
     * @param array{UserGroupsEntity} $usersGroupsEntity
     */
    public function builder(UserEntity $userEntity, array $userRolesEntities): Object
    {
        $rolesFiltered = \array_filter(
            $userRolesEntities,
            fn(UserRoleEntity $userRoleEntity) => $userRoleEntity->getUserId() == $userEntity->getId()
        );
        $groups = \array_map(
            function (UserRoleEntity $userRoleEntity) {
                $role = $userRoleEntity->getRole();

                return (object)[
                    "id" => $role->getId(),
                    "name" => $role->getName(),
                ];
            },
            $rolesFiltered
        );

        return  (object)[
            "id" => $userEntity->getId(),
            "name" => $userEntity->getName(),
            "email" => $userEntity->getDecryptEmail(),
            "phone" => $userEntity->getDecryptPhone(),
            "document" => $userEntity->getDecryptDocument(),
            "document_type" => $userEntity->getDocumentType(),
            "avatar" => $userEntity->getAvatar(),
            "birthdate" => $userEntity->getBirthdate(),
            "roles" => \array_values($groups),
            "status" => $userEntity->getStatus(),
            "created_at" => $userEntity->getCreatedAt(),
            "updated_at" => $userEntity->getUpdatedAt()
        ];
    }
}
