<?php

namespace App\Database\Seeds\Permissions;

use App\Database\Models\Permissions\PermissionsModel;
use CodeIgniter\Database\Seeder;

class RolesPermissionsSeeder extends Seeder
{
    protected array $datas = [
        [
            "role_id" => 1,
            "permission" =>  ['CREATE', 'UPDATE', 'DELETE', 'VIEW']
        ],
        [
            "role_id" => 2,
            "permission" =>  ['CREATE', 'VIEW']
        ],
        [
            "role_id" => 1,
            "permission" =>  ['VIEW']
        ]
    ];

    public function run()
    {
        $prefix = getenv('database.default.DBPrefix');
        $permissionsModel = new PermissionsModel();

        foreach ($this->datas as $data) {
            $foundPermissions = $permissionsModel->whereIn("type", $data['permission'])->findAll();

            foreach ($foundPermissions as $permission) {
                $data = [
                    "role_id" => $data['role_id'],
                    "permission_id" => $permission->getId()
                ];

                // Simple Queries
                $this->db->query(
                    "INSERT INTO  " . $prefix . "roles_permissions (" . join(", ", array_keys($data)) . ") 
                VALUES (" . join(", ", array_map(fn($column) =>  ":$column:", array_keys($data))) . ") 
                ON DUPLICATE KEY UPDATE " . join(", ", array_map(fn($column) =>  "$column = values($column)", array_keys($data))),
                    $data
                );
            }
        }
    }
}
