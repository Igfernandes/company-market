<?php

namespace App\Database\Seeds\Clients;

use App\Database\Entities\Clients\CategoryEntity;
use CodeIgniter\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    public function run()
    {
        helper("json");

        $states = getJson("public/json/address/state.json");

        foreach ($states as  $state) {
            $categoryEntity = new CategoryEntity();

            $categoryEntity->setName($state['name']);
            $categoryEntity->setDescription("O estado no Brasil");

            $prefix = getenv('database.default.DBPrefix');

            $data = array_filter($categoryEntity->attributes, fn($attribute) => !empty($attribute));

            // Simple Queries
            $this->db->query(
                "INSERT INTO  " . $prefix . "categories (" . join(", ", array_keys($data)) . ") 
            VALUES (" . join(", ", array_map(fn($column) =>  ":$column:", array_keys($data))) . ") 
            ON DUPLICATE KEY UPDATE " . join(", ", array_map(fn($column) =>  "$column = values($column)", array_keys($data))),
                $data
            );
        }
    }
}
