<?php

namespace App\Api\Authentications\Auth;

use App\Database\Entities\Users\RememberEntity;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Users\RememberModel;
use App\Database\Models\Users\UsersModel;
use App\Libraries\Crypto\Crypto;
use App\Libraries\Exceptions\Exceptions;
use App\Libraries\Tokens\Tokens;

class PostUseCases
{
    /**
     * @param array{email:string,password:string,g-recaptcha-response:string.rememberMe:string|null} $payload
     */
    public function execute(array $payload)
    {
        $session = session();

        if (!validateRecaptcha($payload['g-recaptcha-response']))
            throw new Exceptions(lang("Validation.recaptcha"), BAD_REQUEST);

        $crypto = new Crypto();
        $userModal = new UsersModel();
        $systemKey = $crypto->encrypt($payload['login'] . ":" . $payload['password'], getenv('system.encrypted_key'));
        $userEntity = new UserEntity($systemKey);

        $userEntity->setEncryptEmail($payload['login']);
        $userEntity->setEncryptPassword($payload['password']);

        $foundUser = $userModal->where($userEntity->toArray(true))->first();

        if (empty($foundUser))
            throw new Exceptions(lang("Api.authentications.auth.post.credentials_invalid"), BAD_BUSINESS_RULES);

        $session->set("userAuth", $foundUser);

        $response = (object)[
            "success" => lang("Api.authentications.auth.post.success"),
        ];

        if (isset($payload['rememberMe'])) {
            $token = new Tokens();
            $rememberModal = new RememberModel();
            $rememberEntity = new RememberEntity();

            $tokenRemember =  $token->create(3);

            $request = \Config\Services::request();
            $ipAddress = $request->getIPAddress();

            $rememberEntity->fill([
                "token" => $tokenRemember,
                "user_id" =>  $foundUser->getId(),
                "ip" =>  $ipAddress ?? '0.0.0.0'
            ]);
            $rememberModal->upsert(["user_id" => $foundUser->getId()], $rememberEntity->toArray(true));

            $response->reference_token = $tokenRemember;
        }

        return $response;
    }
}
