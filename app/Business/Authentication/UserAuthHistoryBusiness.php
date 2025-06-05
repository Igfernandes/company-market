<?php

namespace App\Business\Authentication;

use App\Database\Entities\Users\UserAuthHistoryEntity;
use App\Database\Models\Users\UsersAuthHistoryModel;
use Config\Services;

class UserAuthHistoryBusiness
{
    private UsersAuthHistoryModel $userAuthHistoryModel;

    public function __construct()
    {
        $this->userAuthHistoryModel = new UsersAuthHistoryModel();
    }


    public function handleAuthNavigation(string $token): int|false
    {
        if (empty($token))
            return false;

        $cache = Services::cache();

        $userAuthId = $cache->get($token);

        if (!empty($userAuthId)) {
            return $userAuthId;
        }

        $userAuthHistory = new UserAuthHistoryEntity();
        $userAuthHistory->setToken($token);

        $foundAuthHistory = $this->userAuthHistoryModel->where($userAuthHistory->toArray(true))->first();

        if (empty($foundAuthHistory))
            return false;

        return $foundAuthHistory->getUserId();
    }
}
