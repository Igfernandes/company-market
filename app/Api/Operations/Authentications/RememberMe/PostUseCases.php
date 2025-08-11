<?php

namespace App\Api\Operations\Authentications\RememberMe;

use App\Business\Authentication\AuthenticationBusiness;
use App\Database\Entities\Users\RememberEntity;
use App\Database\Models\Users\RememberModel;
use App\Database\Models\Users\UsersModel;
use App\Libraries\Exceptions\Exceptions;

class PostUseCases
{
    /**
     * @param array{referente-token:string} $payload
     */
    public function execute(array $payload, object $userSettings)
    {
        $rememberEntity = new RememberEntity();
        $rememberModel = new RememberModel();

        $rememberEntity->setToken($payload['reference-token']);
        $foundRemember = $rememberModel->where($rememberEntity->toArray(true))->first();

        if (empty($foundRemember))
            throw new Exceptions("Api.remember.invalid.token", BAD_BUSINESS_RULES);

        $usersModel = new UsersModel();
        $foundUser = $usersModel->where("id", $foundRemember->getUserId())->first();

        if (empty($foundUser))
            throw new Exceptions("Api.remember.invalid.token", BAD_BUSINESS_RULES);

        $authenticationBusiness = new AuthenticationBusiness();

        return (object)[
            "success" => "Api.remember.success.post"
        ];
    }
}
