<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class IntegrationBanks extends Migration
{
    protected $tb_name = "integration_banks";

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'type' => [
                'type' => 'ENUM("MERCADO_PAGO")'
            ],
            'public_token' => [
                'type' => 'VARCHAR(250)',
                'null' => true
            ],
            'private_token' => [
                'type' => 'VARCHAR(250)',
                'null' => true
            ],
            'username' => [
                'type' => 'VARCHAR(100)',
                'null' => true
            ],
            'login' => [
                'type' => 'VARCHAR(200)',
                'null' => true
            ],
            'password' => [
                'type' => 'VARCHAR(100)',
                'null' => true
            ],
            'system_key' => [
                'type' => 'VARCHAR(200)'
            ],
            'created_at datetime default current_timestamp'
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable($this->tb_name);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
