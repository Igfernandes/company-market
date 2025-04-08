<?php

namespace App\Api\Recover\Password\Put;

use App\Database\Entities\Users\UserEntity;
use App\Database\Entities\Users\UserTokenEntity;
use App\Database\Models\Users\UsersModel;
use App\Database\Models\Users\UsersTokensModel;
use App\Libraries\Crypto\Crypto;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\BusinessTrait;
use App\Traits\Services\ServicesDataTrait;

class PutUseCases
{
    use ServicesDataTrait, BusinessTrait;

    /**
     * @param array{
     *     recover_token: string,
     *     password: string
     * } $payload
     */
    public function execute(array $payload)
    {
        $filteredPayload = \array_filter($payload, fn($field) => !empty($field));

        $usersTokensModel = new UsersTokensModel();
        $userTokenEntity = new UserTokenEntity();

        $userTokenEntity->setToken($filteredPayload['recover_token']);

        /** @var array{UserTokenEntity}  */
        $foundToken = $usersTokensModel->getTokenWithUser([], $userTokenEntity->toArray(true));

        if (\count($foundToken) == 0)
            throw new Exceptions(lang("Errors.not_found"), \BAD_BUSINESS_RULES);

        $usersModel = new UsersModel();
        $userEntity = new UserEntity();

        $cryptoLibrary = new Crypto();

        /** @var UserEntity */
        $currentUser = $foundToken[0]->getUser();

        $password = $payload['password'];
        $email = $currentUser->getDecryptEmail();
        $encryptedKey = "$email:$password";

        $systemKey = $cryptoLibrary->encrypt($encryptedKey, getenv('system.encrypted_key'));

        $userEntity->store($currentUser->toArray());
        $userEntity->setSystemKey($systemKey);
        $userEntity->setEncryptEmail($currentUser->getDecryptEmail());
        $userEntity->setEncryptPassword($password);
        $userEntity->setEncryptCpf($currentUser->getDecryptCpf());
        $userEntity->setEncryptPhone($currentUser->getDecryptPhone());
        $userEntity->setEncryptKeyword($currentUser->getDecryptKeyword());

        $usersModel->set($userEntity->toArray())->where(["id" => $currentUser->getId()])->update();

        $usersTokensModel->set([
            "is_valid" => false
        ])->where([
            "id" => $foundToken[0]->getId()
        ])->update();

        return (object)[
            "success" => lang("Api.users.success.alter_password")
        ];
    }
}
