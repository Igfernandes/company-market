<?php

namespace App\Database\Seeds\Users;

use App\Database\Entities\Users\RoleEntity;
use CodeIgniter\Database\Seeder;

class RolesSeeder extends Seeder
{
    protected array $datas = [
        [
            "id" => 1,
            "name" => "Administrator",
            "description" => "The role with all permissions",
            "status" => "ACTIVE"
        ],
        [
            "id" => 2,
            "name" => "employee",
            "description" => "The role with somes permissions",
            "status" => "ACTIVE"
        ],
        [
            "id" => 3,
            "name" => "guide",
            "description" => "The role to user simples",
            "status" => "ACTIVE"
        ],

    ];

    public function run()
    {
        foreach ($this->datas as $data) {
            $prefix = getenv('database.default.DBPrefix');
            $groupsEntity = new RoleEntity();

            $groupsEntity->setId($data['id']);
            $groupsEntity->setName($data['name']);
            $groupsEntity->setDescription($data['description']);
            $groupsEntity->setStatus($data['status']);

            $data = array_filter($groupsEntity->attributes, fn($attribute) => !empty($attribute));

            // Simple Queries
            $this->db->query(
                "INSERT INTO  " . $prefix . "roles (" . join(", ", array_keys($data)) . ") 
                VALUES (" . join(", ", array_map(fn($column) =>  ":$column:", array_keys($data))) . ") 
                ON DUPLICATE KEY UPDATE " . join(", ", array_map(fn($column) =>  "$column = values($column)", array_keys($data))),
                $data
            );
        }
    }
}
