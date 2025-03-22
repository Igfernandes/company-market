<?php

namespace App\Api\Users\Post;

use App\Business\Users\UsersBusiness;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Users\UsersModel;
use App\Libraries\Exceptions\Exceptions;

class PostUseCases
{
    /**
     * @param array{
     *   cpf: string,
     *   password: string,
     *   birthdate: string
     * } $payload
     */
    public function execute(array $payload)
    {
        $usersBusiness = new UsersBusiness();

        if (!$usersBusiness->isCPFAvailable($payload['cpf']))
            throw new Exceptions(\lang(\str_replace("{field}", "email", lang("Validation.already_exists"))));

        $usersModel = new UsersModel();
        $userEntity = new UserEntity();




        return (object)[
            "success" => lang("Api.clients.success.post")
        ];
    }
}
