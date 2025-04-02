<?php

namespace App\Database\Seeds\Fields;

use App\Database\Entities\Fields\FieldsGroupEntity;
use CodeIgniter\Database\Seeder;

class FieldsGroupsSeeder extends Seeder
{
    private $data  = [
        [
            "name" => "BASIC",
            "scope" => "CLIENT,USER"
        ],
        [
            "name" => "SOCIAL",
            "scope" => "CLIENT,USER"
        ],
        [
            "name" => "FINANCE",
            "scope" => "CLIENT,USER"
        ],
        [
            "name" => "ADDRESS",
            "scope" => "CLIENT,USER"
        ],
        [
            "name" => "FAMILY",
            "scope" => "CLIENT,USER"
        ],
        [
            "name" => "OTHERS",
            "scope" => "CLIENT,USER"
        ]
    ];

    public function run()
    {
        $prefix = getenv('database.default.DBPrefix');

        foreach ($this->data as $fieldsGroup) {
            $fieldsGroups = new FieldsGroupEntity();

            $fieldsGroups->setName($fieldsGroup['name']);
            $fieldsGroups->setScope($fieldsGroup['scope']);

            $data = array_filter($fieldsGroups->attributes, fn($attribute) => !empty($attribute));

            $this->db->query(
                "INSERT INTO  " . $prefix . "fields_groups (" . join(", ", array_keys($data)) . ") 
                VALUES (" . join(", ", array_map(fn($column) =>  ":$column:", array_keys($data))) . ") 
                ON DUPLICATE KEY UPDATE " . join(", ", array_map(fn($column) =>  "$column = values($column)", array_keys($data))),
                $data
            );
        }
    }
}
