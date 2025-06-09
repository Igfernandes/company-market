<?php

namespace App\Business\Users;

use App\Business\BaseBusiness;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Users\UsersModel;
use App\Libraries\Exceptions\Exceptions;
use App\Traits\Users\UsersDataTrait;

class UserSingleBusiness
{
    use BaseBusiness, UsersDataTrait;
    /**
     * @param array{
     *     current: string, 
     *     id: int,
     * } $payload
     */
    public function handler($payload): Object
    {
        $session = session();
        $usersModel = new UsersModel();
        $userEntity = new UserEntity();
        $userAuthId = $session->get('userAuthId');

        if (isset($payload['id'])) {
            $userEntity->setId($payload['id']);
        } else $userEntity->setId($userAuthId);

        $foundUserGroup = $usersModel->getUsersWithGroup($userEntity->toArray(true));
        /** @var array{UserEntity} */
        $users = [];

        foreach ($foundUserGroup as $userGroup) {
            $users[$userGroup->getUserId()] = $userGroup->getUser();
        }

        $users = \array_values($users);

        if (count($users) == 0)
            throw new Exceptions(lang("Errors.not_found"), \BAD_BUSINESS_RULES);

        return $this->builder($users[0], $foundUserGroup);
    }
}
