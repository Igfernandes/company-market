<?php

namespace App\Business\Authentications;

use App\Database\Entities\Users\UserAuthHistoryEntity;
use App\Database\Models\Users\UsersAuthHistoryModel;

class UserAuthHistoryBusiness
{
    private UsersAuthHistoryModel $userAuthHistoryModel;

    public function __construct()
    {
        $this->userAuthHistoryModel = new UsersAuthHistoryModel();
    }

    public function store(int $userId, object $userSettings)
    {
        $userAuthHistory = new UserAuthHistoryEntity();

        $userAuthHistory->fill([
            "ip" => $userSettings->ip,
            "browser" => $userSettings->browser,
            "user_id" => $userId
        ]);

        $this->userAuthHistoryModel->save($userAuthHistory);
    }
}
