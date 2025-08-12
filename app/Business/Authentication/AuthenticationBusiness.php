<?php

namespace App\Business\Authentication;

use App\Database\Entities\Users\RememberEntity;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Users\RememberModel;
use App\Libraries\Tokens\Tokens;

class AuthenticationBusiness
{
    private Tokens $tokens;

    public function __construct()
    {
        $this->tokens = new Tokens();
    }

    public function createTokenRemember(array $payload, UserEntity $user)
    {
        if (!isset($payload['remember-me']) || empty($payload['remember-me']))  return;

        $rememberModal = new RememberModel();
        $rememberEntity = new RememberEntity();

        $tokenRemember = $this->tokens->create(3);

        $request = \Config\Services::request();
        $ipAddress = $request->getIPAddress();

        $rememberEntity->fill([
            "token" => $tokenRemember,
            "user_id" =>  $user->getId(),
            "ip" =>  $ipAddress ?? '0.0.0.0'
        ]);
        $rememberModal->upsert(["user_id" => $user->getId()], $rememberEntity);

        return $tokenRemember;
    }
}
