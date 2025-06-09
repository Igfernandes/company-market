<?php

namespace App\Api\Users\Notifications\Post;

use App\Business\Permissions\PermissionsBusiness;

class PostUseCases
{

    public function execute()
    {
        $session = session();
        $userAuthId = $session->get('userAuthId');

        $permissions = PermissionsBusiness::getPermissionUserAuth();
        



        return (object)[
            "success" => lang("Api.groups.success.post")
        ];
    }
}
