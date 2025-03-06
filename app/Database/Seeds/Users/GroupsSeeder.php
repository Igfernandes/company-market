<?php

namespace App\Database\Seeds\Users;

use App\Database\Entities\Users\GroupEntity;
use CodeIgniter\Database\Seeder;

class GroupsSeeder extends Seeder
{
    protected array $datas = [
        [
            "id" => 1,
            "name" => "Admin Master",
            "description" => "The group with all permissions",
            "status" => "ACTIVE"
        ],
        [
            "id" => 2,
            "title" => "employee",
            "description" => "The group with somes permissions",
            "status" => "ACTIVE"
        ],
        [
            "id" => 3,
            "title" => "client",
            "description" => "The group to user simples",
            "status" => "ACTIVE"
        ],

    ];

    public function run()
    {
        foreach ($this->datas as $data) {
            $prefix = getenv('database.default.DBPrefix');
            $groupsEntity = new GroupEntity();

            $groupsEntity->setId($data['id']);
            $groupsEntity->setTitle($data['title']);
            $groupsEntity->setDescription($data['description']);
            $groupsEntity->setStatus($data['status']);

            $data = array_filter($groupsEntity->attributes, fn($attribute) => !empty($attribute));

            // Simple Queries
            $this->db->query(
                "INSERT INTO  " . $prefix . "groups (" . join(", ", array_keys($data)) . ") 
                VALUES (" . join(", ", array_map(fn($column) =>  ":$column:", array_keys($data))) . ") 
                ON DUPLICATE KEY UPDATE " . join(", ", array_map(fn($column) =>  "$column = values($column)", array_keys($data))),
                $data
            );
        }
    }
}
