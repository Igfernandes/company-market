<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ClientsDispatchers extends Migration
{
    protected $tb_name = "clients_dispatchers";

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'client_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'dispatcher_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'status' => [
                'type' => 'ENUM("PENDING", "SUCCESSFUL", "BLOCKED")'
            ],
            'platform' => [
                'type' => 'ENUM("FACEBOOK", "INSTAGRAM", "WHATSAPP", "EMAIL", "SMS")',
                'null' => true
            ],
            'log_error' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'created_at datetime default current_timestamp'
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey("client_id", "clients", ["id"]);
        $this->forge->addForeignKey("dispatcher_id", "dispatchers", ["id"]);
        $this->forge->createTable($this->tb_name, true);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
