<?php

namespace App\Database\Seeds\Users;

use App\Database\Entities\Users\UserGroupsEntity;
use CodeIgniter\Database\Seeder;

class UsersGroupsSeeder extends Seeder
{
    protected array $datas = [
        [
            "user_id"  => 1,
            "group_id" => 1
        ],
    ];

    public function run()
    {
        foreach ($this->datas as $data) {
            $prefix = getenv('database.default.DBPrefix');
            $usersGroupsEntity = new UserGroupsEntity();

            $usersGroupsEntity->setUserId($data['user_id']);
            $usersGroupsEntity->setGroupId($data['group_id']);

            $data = array_filter($usersGroupsEntity->attributes, fn($attribute) => !empty($attribute));

            // Simple Queries
            $this->db->query(
                "INSERT INTO  " . $prefix . "users_groups (" . join(", ", array_keys($data)) . ") 
                VALUES (" . join(", ", array_map(fn($column) =>  ":$column:", array_keys($data))) . ") 
                ON DUPLICATE KEY UPDATE " . join(", ", array_map(fn($column) =>  "$column = values($column)", array_keys($data))),
                $data
            );
        }
    }
}
