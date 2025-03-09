<?php

namespace App\Business\Users;

use App\Business\BaseBusiness;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Users\UsersModel;
use App\Traits\Users\UsersDataTrait;

class UsersBusiness
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
    public function handler($payload): array
    {
        $session = session();
        $usersModel = new UsersModel();
        $userEntity = new UserEntity();

        $in_ids = isset($payload['in_ids']) ? $payload['in_ids'] : [];
        unset($payload['in_ids']);

        $userAuthId = $session->get('userAuthId');

        if (count($in_ids) > 0)
            $usersModel->whereIn("id", $in_ids);

        $payload['owner_id'] = $userAuthId;

        $userEntity->fill($payload);
        $foundUsers = $usersModel->where($payload)->findAll();

        return array_map(fn($userEntity) => $this->builder($userEntity), $foundUsers);
    }
}
