<?php

namespace App\Business\Users\AuthHistory;

use App\Business\BaseBusiness;
use App\Database\Entities\Users\UserAuthHistoryEntity;
use App\Database\Models\Users\UsersAuthHistoryModel;
use App\Database\Models\Users\UsersModel;
use App\Traits\Users\UsersDataTrait;

class UsersAuthHistoryBusiness
{
    use BaseBusiness, UsersDataTrait;

    private UsersModel $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    /**
     * @param array{
     *     tokenNavigation: string
     * } $payload
     */
    public function hasUserAuth($tokenNavigation): int|false
    {
        $userAuthHistory = new UserAuthHistoryEntity();
        $userAuthHistoryModel = new UsersAuthHistoryModel();
        $userAuthHistory->setToken($tokenNavigation);

        /** @var UserAuthHistoryEntity */
        $foundAuthHistory = $userAuthHistoryModel->where($userAuthHistory->toArray(true))->first();

        if (empty($foundAuthHistory))
            return false;

        return $foundAuthHistory->getUserId();
    }
}
