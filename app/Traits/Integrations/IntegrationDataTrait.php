<?php

namespace App\Traits\Integrations;

use App\Database\Entities\Integrations\IntegrationEntity;

trait IntegrationDataTrait
{
    public function builder(IntegrationEntity $integrationEntity): Object
    {
        return  (object)[
            "id" => $integrationEntity->getId(),
            "provider" => $integrationEntity->getProvider(),
            "type" => $integrationEntity->getType(),
            "logotype" => $integrationEntity->getLogotype(),
            "status" => $integrationEntity->getStatus(),
            "public_token" => $integrationEntity->getDecryptPublicToken(),
            "private_token" => $integrationEntity->getDecryptPrivateToken(),
            "username" => $integrationEntity->getUsername(),
            "created_at" => $integrationEntity->getCreatedAt(),
        ];
    }
}
