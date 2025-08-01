<?php

namespace App\Database\Seeds\Users;

use App\Database\Entities\Users\UserRoleEntity;
use CodeIgniter\Database\Seeder;

class UsersRolesSeeder extends Seeder
{
    protected array $datas = [
        [
            "user_id"  => 1,
            "role_id" => 1
        ],
    ];

    public function run()
    {
        foreach ($this->datas as $data) {
            $prefix = getenv('database.default.DBPrefix');
            $userRoleEntity = new UserRoleEntity();

            $userRoleEntity->setUserId($data['user_id']);
            $userRoleEntity->setRoleId($data['role_id']);

            $data = array_filter($userRoleEntity->attributes, fn($attribute) => !empty($attribute));

            // Simple Queries
            $this->db->query(
                "INSERT INTO  " . $prefix . "users_roles (" . join(", ", array_keys($data)) . ") 
                VALUES (" . join(", ", array_map(fn($column) =>  ":$column:", array_keys($data))) . ") 
                ON DUPLICATE KEY UPDATE " . join(", ", array_map(fn($column) =>  "$column = values($column)", array_keys($data))),
                $data
            );
        }
    }
}
