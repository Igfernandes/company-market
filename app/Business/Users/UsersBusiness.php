<?php

namespace App\Business\Users;

use App\Business\BaseBusiness;
use App\Database\Entities\Users\UserEntity;
use App\Database\Models\Users\UsersModel;
use App\Libraries\Crypto\Crypto;
use App\Traits\Users\UsersDataTrait;

/**
 * @phpstan-import-type UserShape from \App\Types\Users\User.type
 */

class UsersBusiness
{
    use BaseBusiness, UsersDataTrait;

    private UsersModel $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        helper(['crypto']);
    }

    public function isDocumentAvailable(string $document, int $userId = 0)
    {
        if ($userId > 0)
            $this->usersModel->where("id !=", $userId);

        $foundUser = $this->usersModel->where("document_sha256", \referenceHash($document))->first();

        return empty($foundUser);
    }


    public function isEmailAvailable(string $email,  int $userId = 0)
    {
        if ($userId > 0)
            $this->usersModel->where("id !=", $userId);

        $foundUser = $this->usersModel->where("email_sha256", \referenceHash($email))->first();

        return empty($foundUser);
    }

    public function isPhoneAvailable(string $phone,  int $userId = 0)
    {
        if ($userId > 0)
            $this->usersModel->where("id !=", $userId);

        $foundUser = $this->usersModel->where("phone_sha256", \referenceHash($phone))->first();

        return empty($foundUser);
    }

    public function hasUser($query): null|UserEntity
    {
        return $this->usersModel->withDeleted()->where($query)->first();
    }

    /**
     * @param UserShape $payload
     * @param string $encryptedKey
     * 
     * @return UserEntity
     */
    public function store(array $payload, string $encryptedKey): UserEntity
    {
        $crypto = new Crypto();

        $systemKey = $crypto->encrypt($encryptedKey, getenv('system.encrypted_key'));

        $alteredUser = new UserEntity();

        $alteredUser->store($payload);
        $alteredUser->setSystemKey($systemKey);

        if (isset($payload['phone'])) {
            $alteredUser->setPhoneSha256(referenceHash($payload['phone']));
            $alteredUser->setEncryptPhone($payload['phone']);
        }

        if (isset($payload['document'])) {
            $alteredUser->setEncryptDocument($payload['document']);
            $alteredUser->setDocumentSha256(\referenceHash($payload['document']));
        }

        if (isset($payload['email'])) {
            $alteredUser->setEncryptEmail($payload['email']);
            $alteredUser->setEmailSha256(referenceHash($payload['email']));
        }

        if (isset($payload['password']) || !empty($payload['password']))
            $alteredUser->setEncryptPassword($payload['password']);

        if (isset($payload['keyword']) && !empty($payload['keyword']))
            $alteredUser->setEncryptKeyword($payload['keyword']);

        $alreadyUser = null;

        if (isset($payload['id'])) {
            $alreadyUser = $this->hasUser([
                "id" => $payload['id']
            ]);
        }

        $data =  $alteredUser->toArray(true);
        $data['deleted_at'] = null;

        if (empty($alreadyUser))
            $this->usersModel->protect(!isset($payload['id']))->insert($data);
        else $this->usersModel->save($data);

        $alteredUser->setId($this->usersModel->getInsertID());

        return $alteredUser;
    }
}
