<?php

namespace App\Api\Authentications\Auth;

use App\Business\Authentication\AuthenticationBusiness;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Users\UsersModel;
use App\Libraries\Crypto\Crypto;
use App\Libraries\Exceptions\Exceptions;

class PostUseCases
{
    /**
     * @param array{email:string,password:string,recaptcha:string.rememberMe:string|null} $payload
     * @param object{browser:string;ip:string} $userSettings
     */
    public function execute(array $payload, object $userSettings)
    {
        if (!validateRecaptcha([
            "token" => $payload['recaptcha'],
            "userId" => $userSettings->ip
        ]) && $payload['recaptcha'] !==  \getenv("globals.recaptcha.tokenTest"))
            throw new Exceptions("Api.auth.invalid.recaptcha", BAD_REQUEST);

        $authenticationBusiness = new AuthenticationBusiness();

        $crypto = new Crypto();
        $userModel = new UsersModel();
        $systemKey = $crypto->encrypt($payload['login'] . ":" . $payload['password'], getenv('system.encrypted_key'));
        $userEntity = new UserEntity();

        $userEntity->setSystemKey($systemKey);
        $userEntity->setEncryptEmail($payload['login']);
        $userEntity->setEncryptPassword($payload['password']);

        $foundUser = $userModel->where($userEntity->toArray(true))->first();

        if (empty($foundUser))
            throw new Exceptions("Api.auth.invalid.credentials", BAD_BUSINESS_RULES);

        $tokenNavigation = $authenticationBusiness->createTokenNavigation($foundUser, $userSettings);

        $response = (object)[
            "success" => "Api.auth.success.post",
            "token_navigation" => $tokenNavigation
        ];

        $tokenRemember = $authenticationBusiness->createTokenRemember($payload, $foundUser);

        if (!empty($tokenRemember))
            $response->reference_token = $tokenRemember;

        return $response;
    }
}
