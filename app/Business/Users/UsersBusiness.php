<?php

namespace App\Business\Users;

use App\Business\BaseBusiness;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Users\UsersModel;
use App\Libraries\Crypto\Crypto;
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
        $userEntity = new UserEntity();
        $usersModel = new UsersModel();

        $userEntity->fill($payload);

        $foundUserGroup = $usersModel->getUsersWithGroup($userEntity->toArray(true));
        /** @var array{UserEntity} */
        $users = [];

        foreach ($foundUserGroup as $userGroup) {
            $users[$userGroup->getUserId()] = $userGroup->getUser();
        }

        return \array_values(array_map(fn($userEntity) => $this->builder($userEntity, $foundUserGroup), $users));
    }


    public function isCPFAvailable(string $cpf, int $userId = 0)
    {
        if ($userId > 0)
            $this->usersModel->where("id !=", $userId);

        $foundUser = $this->usersModel->where("cpf_sha1", \sha1($cpf))->first();

        return empty($foundUser);
    }


    public function isEmailAvailable(string $email,  int $userId = 0)
    {
        if ($userId > 0)
            $this->usersModel->where("id !=", $userId);

        $foundUser = $this->usersModel->where("email_sha1", \sha1($email))->first();

        return empty($foundUser);
    }

    public function isPhoneAvailable(string $phone,  int $userId = 0)
    {
        if ($userId > 0)
            $this->usersModel->where("id !=", $userId);

        $foundUser = $this->usersModel->where("phone_sha1", \sha1($phone))->first();

        return empty($foundUser);
    }

    public function hasUser($query): bool
    {
        $usersModel = new UsersModel();

        $foundUsers = $usersModel->where($query)->find();

        return !empty($foundUsers);
    }

    public function updateEncryptionReferences(UserEntity $user, string $password, string $email): UserEntity
    {
        $crypto = new Crypto();
        $encryptedKey = "$email:$password";

        $systemKey = $crypto->encrypt($encryptedKey, getenv('system.encrypted_key'));

        $newUser = new UserEntity();

        $newUser->store($user->toArray());
        $newUser->setSystemKey($systemKey);
        $newUser->setEncryptEmail($user->getDecryptEmail());
        $newUser->setEncryptPassword($password);
        $newUser->setEncryptCpf($user->getDecryptCpf());
        $newUser->setEncryptPhone($user->getDecryptPhone());
        $newUser->setEncryptKeyword($user->getDecryptKeyword());

        return  $newUser;
    }
}
