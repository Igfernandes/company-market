<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GroupsPermissions extends Migration
{
    protected $tb_name = "groups_permissions";

    public function up()
    {
        $this->forge->addField([
            'permission_id' => [
                'type' => 'INT',
                'unsigned'       => true,
            ],
            'group_id' => [
                'type' => 'INT',
                'unsigned'       => true,
            ],
            'created_at datetime default current_timestamp',
        ]);

        $this->forge->addKey(['permission_id', 'group_id'], true);
        $this->forge->addForeignKey("permission_id", "permissions", ["id"]);
        $this->forge->addForeignKey("group_id", "groups", ["id"]);

        $this->forge->createTable($this->tb_name);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
