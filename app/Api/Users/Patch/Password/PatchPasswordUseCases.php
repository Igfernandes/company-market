<?php

namespace App\Api\Users\Patch\Password;

use App\Business\Users\UsersBusiness;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Users\UsersModel;
use App\Libraries\Crypto\Crypto;
use App\Libraries\Exceptions\Exceptions;

class PatchPasswordUseCases
{
    /**
     * @param array{
     *   id: int,
     *   current_password: string,
     *   password: string
     * } $payload
     */
    public function execute(array $payload)
    {
        $usersBusiness = new UsersBusiness();
        $userId = $payload['id'];

        if (!$usersBusiness->hasUser([
            "id" => $userId
        ]))
            throw new Exceptions("Api.users.invalid.not_found", \BAD_BUSINESS_RULES);

        if (!preg_match(\VALIDATE_PASSWORD, $payload['current_password']) || !preg_match(\VALIDATE_PASSWORD, $payload['password']))
            throw new Exceptions("Api.users.invalid.incorrect_password_formatted", \BAD_BUSINESS_RULES);

        $usersModel = new UsersModel();

        /** @var UserEntity */
        $foundUser = $usersModel->where(["id" => $userId])->first();

        if (empty($foundUser))
            throw new Exceptions("Api.users.invalid.not_found", \BAD_BUSINESS_RULES);

        $email = $foundUser->getDecryptEmail();
        $newUser = $usersBusiness->updateEncryptionReferences($foundUser, $payload['password'], $email);

        $crypto = new Crypto();

        $systemKey = $crypto->encrypt("$email:" . $payload['current_password'], getenv('system.encrypted_key'));

        if ($foundUser->getSystemKey() !==  $systemKey)
            throw new Exceptions("Api.users.invalid.not_found", \BAD_BUSINESS_RULES);

        $usersModel->save($newUser);

        return (object)[
            "success" => "Api.users.success.patch_password"
        ];
    }
}
