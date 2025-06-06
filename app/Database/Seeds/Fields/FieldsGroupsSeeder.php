<?php

namespace App\Database\Seeds\Fields;

use App\Database\Entities\Fields\FieldsGroupEntity;
use CodeIgniter\Database\Seeder;

class FieldsGroupsSeeder extends Seeder
{
    private $data  = [
        [
            "name" => "BASIC"
        ],
        [
            "name" => "SOCIAL"
        ],
        [
            "name" => "FINANCE"
        ],
        [
            "name" => "ADDRESS"
        ],
        [
            "name" => "FAMILY"
        ],
        [
            "name" => "OTHERS"
        ],
        [
            "name" => "ATTACHMENTS"
        ]
    ];

    public function run()
    {
        $prefix = getenv('database.default.DBPrefix');
        $scopes = ["USER", "CLIENT"];

        foreach ($this->data as $fieldsGroup) {
            foreach ($scopes as $scope) {
                $fieldsGroups = new FieldsGroupEntity();

                $fieldsGroups->setName($fieldsGroup['name']);
                $fieldsGroups->setScope($scope);

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
}
