<?php

namespace App\Traits\Users;

use App\Database\Entities\Users\UserEntity;
use App\Database\Entities\Users\UserGroupsEntity;

trait GroupsDataTrait
{
    /**
     * 
     * @param UserEntity $userEntity
     * @param array{UserGroupsEntity} $usersGroupsEntity
     */
    public function builder(UserEntity $userEntity, array $userGroupsEntities): Object
    {
        $groupsFiltered = \array_filter(
            $userGroupsEntities,
            fn(UserGroupsEntity $userGroupEntity) => $userGroupEntity->getUserId() == $userEntity->getId()
        );
        $groups = \array_map(
            fn(UserGroupsEntity $userGroupsEntity) => $userGroupsEntity->getGroup()->getName(),
            $groupsFiltered
        );

        return  (object)[
            "id" => $userEntity->getId(),
            "name" => $userEntity->getName(),
            "email" => $userEntity->getDecryptEmail(),
            "phone" => $userEntity->getDecryptPhone(),
            "cpf" => $userEntity->getDecryptCpf(),
            "avatar" => $userEntity->getAvatar(),
            "birthdate" => $userEntity->getBirthdate(),
            "groups" => join(",", $groups),
            "status" => $userEntity->getStatus(),
            "created_at" => $userEntity->getCreatedAt(),
            "updated_at" => $userEntity->getUpdatedAt()
        ];
    }
}
