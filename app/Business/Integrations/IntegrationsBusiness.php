<?php

namespace App\Business\Integrations;

use App\Business\BaseBusiness;
use App\Database\Entities\Integrations\IntegrationBankEntity;
use App\Database\Entities\Integrations\IntegrationChatEntity;
use App\Database\Models\Integrations\IntegrationBanksModel;
use App\Database\Models\Integrations\IntegrationChatsModel;
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

    public function store(IntegrationBankEntity|IntegrationChatEntity $entity, IntegrationBanksModel|IntegrationChatsModel $model, array $payload): IntegrationBankEntity|IntegrationChatEntity
    {
        $crypto = new Crypto();
        $entity->setSystemKey($crypto->encrypt($payload['type'], getenv('system.encrypted_key')));

        $entity->setType($payload['type']);

        if (isset($payload['private_token']) && !empty($payload['private_token']))
            $entity->setEncryptPrivateToken($payload['private_token']);
        if (isset($payload['public_token']) && !empty($payload['public_token']))
            $entity->setEncryptPublicToken($payload['public_token']);
        if (isset($payload['username']) && !empty($payload['username']))
            $entity->setUsername($payload['username']);
        if (isset($payload['password']) && !empty($payload['password']))
            $entity->setEncryptPassword($payload['password']);
        if (isset($payload['login']) && !empty($payload['login']))
            $entity->setEncryptLogin($payload['login']);

        $model->upsert(["type" => $payload['type']], $entity);

        return $entity;
    }
}
