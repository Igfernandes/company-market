<?php

namespace App\Api\Operations\Authentications\Auth;

use App\Business\Authentications\RememberBusiness;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Users\UsersModel;
use App\Libraries\Crypto\Crypto;
use App\Libraries\Exceptions\Exceptions;

class PostUseCases
{
    /**
     * @param array{email:string,password:string,recaptcha:string.remember-me:string|null} $payload
     * @param object{browser:string;ip:string} $userSettings
     */
    public function execute(array $payload, object $userSettings)
    {
        if (!validateRecaptcha([
            "token" => $payload['recaptcha'],
            "ip" => $userSettings->ip
        ]))
            throw new Exceptions("Api.auth.invalid.recaptcha", BAD_AUTH);


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

        $response = (object)[
            "success" => "Api.auth.success.post"
        ];

        $rememberBusiness = new RememberBusiness();
        $tokenRemember = $rememberBusiness->createTokenRemember($payload, $foundUser, $userSettings);

        if (!empty($tokenRemember))
            $response->reference_token = $tokenRemember;

        $session = session();
        $session->set(SESSION_KEY_AUTH_USER, $foundUser);

        return $response;
    }
}
