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
            "email" => $userEntity->getDecryptEmail(),
            "phone" => $userEntity->getDecryptPhone(),
            "cpf" => $userEntity->getDecryptCpf(),
            "avatar" => $userEntity->getAvatar(),
            "birthdate" => $userEntity->getBirthdate(),
            "status" => $userEntity->getStatus(),
            "created_at" => $userEntity->getCreatedAt(),
            "updated_at" => $userEntity->getUpdatedAt()
        ];
    }
}
