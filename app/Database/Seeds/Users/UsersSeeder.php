<?php

namespace App\Database\Seeds\Users;

use App\Database\Entities\Users\UserEntity;
use App\Libraries\Crypto\Crypto;
use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $cryptoLibrary = new Crypto();

        $password = getenv("globals.admin.password");
        $email = getenv("globals.admin.login");
        $cryptedKey = "$email:$password";

        $systemKey = $cryptoLibrary->encrypt($cryptedKey, getenv('system.encrypted_key'));
        $userEntity = new UserEntity();
        $USER_ID = 1;

        $userEntity->setSystemKey($systemKey);
        $userEntity->setId($USER_ID);
        $userEntity->setEncryptEmail($email);
        $userEntity->setEncryptPassword($password);
        $userEntity->setAvatar(site_url(getenv("globals.admin.photo")));
        $userEntity->setEncryptCpf(getenv("globals.admin.cpf"));
        $userEntity->setEncryptPhone(getenv("globals.admin.phone"));
        $userEntity->setName(getenv("globals.admin.name"));
        $userEntity->setEmailSha1(sha1(getenv("globals.admin.login")));
        $userEntity->setBirthdate(getenv("globals.admin.birthdate"));
        $userEntity->setStatus("ACTIVE");
        $userEntity->setEncryptKeyword(getenv("globals.admin.keyword"));
        $userEntity->setOwnerId($USER_ID);

        $prefix = getenv('database.default.DBPrefix');

        $data = array_filter($userEntity->attributes, fn($attribute) => !empty($attribute));

        // Simple Queries
        $this->db->query(
            "INSERT INTO  " . $prefix . "users (" . join(", ", array_keys($data)) . ") 
            VALUES (" . join(", ", array_map(fn($column) =>  ":$column:", array_keys($data))) . ") 
            ON DUPLICATE KEY UPDATE " . join(", ", array_map(fn($column) =>  "$column = values($column)", array_keys($data))),
            $data
        );
    }
}
