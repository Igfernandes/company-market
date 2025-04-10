<?php

namespace App\Traits\Integrations;

use App\Database\Entities\Integrations\IntegrationBankEntity;

trait IntegrationBanksDataTrait
{
    public function builder(IntegrationBankEntity $integrationBankEntity): Object
    {

        return  (object)[
            "id" => $integrationBankEntity->getId(),
            "type" => $integrationBankEntity->getType(),
            "public_token" => $integrationBankEntity->getDecryptPublicToken(),
            "private_token" => $integrationBankEntity->getDecryptPrivateToken(),
            "login" => $integrationBankEntity->getDecryptLogin(),
            "password" => $integrationBankEntity->getDecryptPassword(),
            "username" => $integrationBankEntity->getUsername(),
            "created_at" => $integrationBankEntity->getCreatedAt(),
        ];
    }
}
