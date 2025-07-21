<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersAuthHistory extends Migration
{
    protected $tb_name = "users_auth_history";

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'ip' => [
                'type' => 'VARCHAR',
                'constraint' => '30'
            ],
            'browser' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'token' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'unique'     => true
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'created_at datetime default current_timestamp'
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey("user_id", "users", ["id"]);
        $this->forge->createTable($this->tb_name, true);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
