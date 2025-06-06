<?php

namespace App\Business\Integrations;

use App\Business\BaseBusiness;
use App\Database\Entities\Integrations\IntegrationEntity;
use App\Database\Models\Integrations\IntegrationsModel;
use App\Database\Models\Users\UsersModel;
use App\Libraries\Crypto\Crypto;
use App\Traits\Users\UsersDataTrait;

class IntegrationsBusiness
{
    use BaseBusiness, UsersDataTrait;

    private UsersModel $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function store(IntegrationEntity $entity, IntegrationsModel $model, array $payload): IntegrationEntity
    {
        $crypto = new Crypto();
        $entity->setSystemKey($crypto->encrypt($payload['type'], getenv('system.encrypted_key')));

        $entity->setType($payload['type']);

        $entity->setEncryptPrivateToken($payload['private_token']);
        $entity->setEncryptPublicToken($payload['public_token']);

        if (!empty($payload['status']))
            $entity->setStatus($payload['status']);
        if (!empty($payload['username']))
            $entity->setUsername($payload['username']);

        $model->upsert(["provider" => $payload['provider']], $entity);

        return $entity;
    }
}
