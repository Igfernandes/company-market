<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Invites extends Migration
{
    protected $tb_name = "invites";

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'token' => [
                'type' => 'VARCHAR(100)'
            ],
            'type' => [
                'type' => 'ENUM("USER", "COMPANY")',
            ],
            'data' => [
                'type' => 'BLOB'
            ],
            'expired_at' => [
                'type' => 'DATETIME',
            ],
            'is_valid' => [
                'type' => 'BOOLEAN'
            ],
            'email_sha256' => [
                'type' => 'VARCHAR(70)'
            ],
            'owner_id' => [
                'type' => 'INT',
                'null' => true,
                'unsigned' => true
            ],
            'created_at datetime default current_timestamp',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable($this->tb_name, true);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
