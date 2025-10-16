<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersRoles extends Migration
{
    protected $tb_name = "users_roles";

    public function up()
    {
        $this->forge->addField([
            'role_id' => [
                'type' => 'INT',
                'unsigned'       => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned'       => true,
            ],
            'created_at datetime default current_timestamp',
        ]);

        $this->forge->addKey(['role_id', 'user_id'], true);
        $this->forge->addForeignKey("role_id", "roles", ["id"], 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey("user_id", "users", ["id"], 'CASCADE', 'CASCADE');

        $this->forge->createTable($this->tb_name, true);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
