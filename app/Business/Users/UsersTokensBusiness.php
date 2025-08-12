<?php

namespace App\Business\Users;

use App\Business\BaseBusiness;
use App\Database\Entities\Users\UserTokenEntity;
use App\Database\Models\Users\UsersTokensModel;
use App\Traits\Users\UsersDataTrait;

class UsersTokensBusiness
{
    use BaseBusiness, UsersDataTrait;

    private UsersTokensModel $usersTokensModel;

    public function __construct()
    {
        $this->usersTokensModel = new UsersTokensModel();
        helper(['crypto']);
    }

    public function getAvailableRelationUserToken(?string $token): UserTokenEntity|null
    {
        if (empty($token)) return null;

        $usersTokensModel = new UsersTokensModel();
        $userTokenEntity = new UserTokenEntity();

        $userTokenEntity->setToken($token);
        $userTokenEntity->setIsValid(true);

        /** @var array{UserTokenEntity}  */
        $foundToken = $usersTokensModel->getTokenWithUser([], $userTokenEntity->toArray(true));

        return count($foundToken) > 0 ? $foundToken[0] : null;
    }
}
