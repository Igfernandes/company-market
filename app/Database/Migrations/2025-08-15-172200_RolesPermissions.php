<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RolesPermissions extends Migration
{
    protected $tb_name = "roles_permissions";

    public function up()
    {
        $this->forge->addField([
            'permission_id' => [
                'type' => 'INT',
                'unsigned'       => true
            ],
            'role_id' => [
                'type' => 'INT',
                'unsigned'       => true
            ],
            'created_at datetime default current_timestamp',
        ]);

        $this->forge->addKey(['permission_id', 'role_id'], true);
        $this->forge->addForeignKey("permission_id", "permissions", ["id"]);
        $this->forge->addForeignKey("role_id", "roles", ["id"]);

        $this->forge->createTable($this->tb_name, true);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
