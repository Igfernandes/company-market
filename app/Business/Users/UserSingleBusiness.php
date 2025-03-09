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
     *     in_ids: array<int>, 
     *     name: string, 
     *     cpf: string, 
     *     phone: string, 
     *     birthdate: string, 
     *     status: 'ACTIVE' | 'INACTIVE', 
     *     created_at: string, 
     *     updated_at: string 
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
            $userEntity->setOwnerId($userAuthId);
        } else $userEntity->setId($userAuthId);

        /** @var UserEntity */
        $foundUser = $usersModel->where($userEntity->toArray(true))->first();

        if (empty($foundUser))
            throw new Exceptions(lang("Errors.not_found"), \BAD_BUSINESS_RULES);

        return $this->builder($foundUser);
    }
}
