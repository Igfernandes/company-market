<?php

namespace App\Traits\Integrations;

use App\Database\Entities\Integrations\IntegrationChatEntity;

trait IntegrationChatsDataTrait
{
    public function builder(IntegrationChatEntity $integrationChatEntity): Object
    {

        return  (object)[
            "id" => $integrationChatEntity->getId(),
            "type" => $integrationChatEntity->getType(),
            "public_token" => $integrationChatEntity->getDecryptPublicToken(),
            "private_token" => $integrationChatEntity->getDecryptPrivateToken(),
            "login" => $integrationChatEntity->getDecryptLogin(),
            "password" => $integrationChatEntity->getDecryptPassword(),
            "username" => $integrationChatEntity->getUsername(),
            "created_at" => $integrationChatEntity->getCreatedAt(),
        ];
    }
}
