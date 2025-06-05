<?php

namespace App\Database\Seeds\Users;

use CodeIgniter\Database\Seeder;

class UsersFieldsSeeder extends Seeder
{
    protected array $datas = [];

    public function run()
    {
        foreach ($this->datas as $data) {
            $prefix = getenv('database.default.DBPrefix');
            $usersFieldsEntity = new UserFieldEntity();

            $usersFieldsEntity->setLabel($data['label']);
            $usersFieldsEntity->setValue($data['value']);
            $usersFieldsEntity->setUserId($data['user_id']);

            $data = array_filter($usersFieldsEntity->attributes, fn ($attribute) => !empty($attribute));

            // Simple Queries
            $this->db->query(
                "INSERT INTO  " . $prefix . "users_fields (" . join(", ", array_keys($data)) . ") 
                VALUES (" . join(", ", array_map(fn ($column) =>  ":$column:", array_keys($data))) . ") 
                ON DUPLICATE KEY UPDATE " . join(", ", array_map(fn ($column) =>  "$column = values($column)", array_keys($data))),
                $data
            );
        }
    }
}
