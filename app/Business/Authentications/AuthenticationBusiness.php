<?php

namespace App\Business\Authentications;

use App\Business\BaseBusiness;
use App\Database\Entities\Users\UserEntity;

class AuthenticationBusiness
{
    use BaseBusiness;

    /**
     * @param UserEntity $user Os novos dados do usuário autenticado dessa sessão
     */
    public static function revokeSession(UserEntity $user)
    {
        $session = \session();

        $session->set(\SESSION_KEY_AUTH_USER, $user);
    }
}
