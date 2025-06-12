<?php

namespace App\Api\Authentications\RememberMe;

use App\Database\Entities\Users\RememberEntity;
use App\Database\Models\Users\RememberModel;
use App\Database\Models\Users\UsersModel;
use App\Libraries\Exceptions\Exceptions;

class PostUseCases
{
    /**
     * @param array{referente-token:string} $payload
     */
    public function execute(array $payload)
    {
        $session = session();
        $rememberEntity = new RememberEntity();
        $rememberModel = new RememberModel();

        $rememberEntity->setToken($payload['reference-token']);
        $foundRemember = $rememberModel->where($rememberEntity->toArray(true))->first();

        if (empty($foundRemember))
            throw new Exceptions("Api.remember.invalid.token_invalid", BAD_BUSINESS_RULES);

        $usersModel = new UsersModel();
        $foundUser = $usersModel->first($foundRemember->getUserId());

        if (empty($foundUser))
            throw new Exceptions((lang("Api.remember.invalid.token_invalid")), BAD_BUSINESS_RULES);

        $session->set("userAuth", $foundUser);

        $response = (object)[
            "success" => "Api.remember.success.post",
        ];

        return $response;
    }
}
