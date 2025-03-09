<?php

namespace App\Traits\Users;

use App\Database\Entities\Users\UserEntity;

trait UsersDataTrait
{
    public function builder(UserEntity $userEntity): Object
    {
        return  (object)[
            "id" => $userEntity->getId(),
            "name" => $userEntity->getName(),
            "email" => $userEntity->getEncryptEmail(),
            "phone" => $userEntity->getEncryptPhone(),
            "cpf" => $userEntity->getEncryptCpf(),
            "avatar" => $userEntity->getAvatar(),
            "birthdate" => $userEntity->getBirthdate(),
            "status" => $userEntity->getStatus(),
            "created_at" => $userEntity->getCreatedAt(),
            "updated_at" => $userEntity->getUpdatedAt()
        ];
    }
}
