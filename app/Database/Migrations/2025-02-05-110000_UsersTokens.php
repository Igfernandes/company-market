<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersTokens extends Migration
{
    protected $tb_name = "users_tokens";

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
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'operation' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'path' => [
                'type'       => 'VARCHAR',
                'constraint' => '450'
            ],
            'data' => [
                'type'       => 'JSON'
            ],
            'is_valid' => [
                'type'       => 'BIT'
            ],
            'accessibility' => [
                'type'       => 'ENUM("PUBLIC", "PRIVATE")',
                'default'   => 'PRIVATE'
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'expired_at' => [
                'type' => 'DATETIME',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey("user_id", "users", ["id"]);

        $this->forge->createTable($this->tb_name);
    }

    public function down()
    {

        $this->forge->dropTable($this->tb_name);
    }
}
