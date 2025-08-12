<?php

namespace App\Api\Operations\Recovers\Password\Put;

use App\Business\Users\UsersBusiness;
use App\Business\Users\UsersTokensBusiness;
use App\Database\Entities\Users\UserEntity;
use App\Database\Entities\Users\UserTokenEntity;
use App\Database\Models\Users\UsersModel;
use App\Database\Models\Users\UsersTokensModel;
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
        $usersTokensBusiness = new UsersTokensBusiness();

        /** @var array{UserTokenEntity}  */
        $foundToken = $usersTokensBusiness->getAvailableRelationUserToken($filteredPayload['recover_token']);

        if (empty($foundToken))
            throw new Exceptions("Api.recover.password.invalid.token", BAD_BUSINESS_RULES);

        $usersModel = new UsersModel();
        $userEntity = new UserEntity();
        $usersBusiness = new UsersBusiness();

        /** @var UserEntity */
        $currentUser = $foundToken[0]->getUser();

        if (empty($currentUser))
            throw new Exceptions("Api.users.invalid.not_found", BAD_REQUEST);

        $password = $payload['password'];
        $email = $currentUser->getDecryptEmail();
        $userEntity = $usersBusiness->updateEncryptionReferences($currentUser, $password,  $email);

        $usersModel->set($userEntity->toArray())->where(["id" => $currentUser->getId()])->update();

        $usersTokensModel->set([
            "is_valid" => false
        ])->where([
            "id" => $foundToken[0]->getId()
        ])->update();

        return (object)[
            "success" => "Api.users.success.alter_password"
        ];
    }
}
