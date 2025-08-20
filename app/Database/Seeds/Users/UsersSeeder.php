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
        \helper(['crypto']);

        $password = getenv("globals.admin.password");
        $email = getenv("globals.admin.login");
        $encryptedKey = "$email:$password";

        $systemKey = $cryptoLibrary->encrypt($encryptedKey, getenv('system.encrypted_key'));
        $userEntity = new UserEntity();
        $USER_ID = 1;

        $userEntity->setSystemKey($systemKey);
        $userEntity->setId($USER_ID);
        $userEntity->setEncryptEmail($email);
        $userEntity->setEncryptPassword($password);
        $userEntity->setAvatar(site_url(getenv("globals.admin.photo")));
        $userEntity->setEncryptDocument(getenv("globals.admin.document"));
        $userEntity->setDocumentType(getenv("globals.admin.document_type"));
        $userEntity->setEncryptPhone(getenv("globals.admin.phone"));
        $userEntity->setName(getenv("globals.admin.name"));
        $userEntity->setEmailSha256(referenceHash(getenv("globals.admin.login")));
        $userEntity->setPhoneSha256(referenceHash(getenv("globals.admin.phone")));
        $userEntity->setDocumentSha256(referenceHash(getenv("globals.admin.cpf")));
        $userEntity->setBirthdate(getenv("globals.admin.birthdate"));
        $userEntity->setStatus("ACTIVE");
        $userEntity->setEncryptKeyword(getenv("globals.admin.keyword"));

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
