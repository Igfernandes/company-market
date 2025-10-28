<?php

namespace App\Database\Seeds\Permissions;

use CodeIgniter\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $prefix = getenv('database.default.DBPrefix');
        $ACTIONS = ['CREATE', 'UPDATE', 'DELETE', 'VIEW'];

        $permissionsGroup = ["users", "forms", "companies", "forms_fills", "services", "dispatchers", "schedules", "clients", "categories", "charges", "integrations", "fields"];

        foreach ($permissionsGroup as $permissionGroup) {
            foreach ($ACTIONS as $action) {
                $data = [
                    "name" => strtolower($permissionGroup . "_" . $action),
                    "type" => $action,
                    "scope" => $permissionGroup
                ];

                // Simple Queries
                $this->db->query(
                    "INSERT INTO  " . $prefix . "permissions (" . join(", ", array_keys($data)) . ") 
                VALUES (" . join(", ", array_map(fn($column) =>  ":$column:", array_keys($data))) . ") 
                ON DUPLICATE KEY UPDATE " . join(", ", array_map(fn($column) =>  "$column = values($column)", array_keys($data))),
                    $data
                );
            }
        };
    }
}
