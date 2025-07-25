<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Integrations extends Migration
{
    protected $tb_name = "integrations";

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'logotype' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'username' => [
                'type' => 'VARCHAR(100)',
                'null' => true
            ],
            'provider' => [
                'type' => 'VARCHAR(40)',
                'unique' => true
            ],
            'type' => [
                'type' => 'ENUM("BANK", "CHAT")'
            ],
            'public_token' => [
                'type' => 'BLOB',
                'null' => true
            ],
            'private_token' => [
                'type' => 'BLOB',
                'null' => true
            ],
            'status' => [
                'type' => 'ENUM("ACTIVE", "INACTIVE", "ANALYSIS")',
                'default' => "ANALYSIS"
            ],
            'system_key' => [
                'type' => 'BLOB'
            ],
            'created_at datetime default current_timestamp'
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable($this->tb_name, true);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
