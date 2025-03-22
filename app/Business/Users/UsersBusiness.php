<?php

namespace App\Business\Users;

use App\Business\BaseBusiness;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Users\UsersModel;
use App\Traits\Users\UsersDataTrait;

class UsersBusiness
{
    use BaseBusiness, UsersDataTrait;

    private UsersModel $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }


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

        $userEntity = new UserEntity();

        $in_ids = isset($payload['in_ids']) ? $payload['in_ids'] : [];
        unset($payload['in_ids']);

        $userAuthId = $session->get('userAuthId');

        if (count($in_ids) > 0)
            $this->usersModel->whereIn("id", $in_ids);

        $payload['owner_id'] = $userAuthId;

        $userEntity->fill($payload);
        $foundUsers = $this->usersModel->where($payload)->findAll();

        return array_map(fn($userEntity) => $this->builder($userEntity), $foundUsers);
    }


    public function isCPFAvailable(string $cpf)
    {
        $foundUser = $this->usersModel->where("cpf_sha1", \sha1($cpf))->first();

        return empty($foundUser);
    }


    public function isEmailAvailable(string $email)
    {
        $foundUser = $this->usersModel->where("email_sha1", \sha1($email))->first();

        return empty($foundUser);
    }

    public function isPhoneAvailable(string $phone)
    {
        $foundUser = $this->usersModel->where("phone_sha1", \sha1($phone))->first();

        return empty($foundUser);
    }
}
