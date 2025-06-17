<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ClientsServices extends Migration
{
    protected $tb_name = "clients_services";

    public function up()
    {
        $this->forge->addField([
            'client_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'service_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'created_at datetime default current_timestamp'
        ]);

        $this->forge->addKey(['client_id', 'service_id'], true);

        $this->forge->addForeignKey("client_id", "clients", ["id"]);
        $this->forge->addForeignKey("service_id", "services", ["id"]);

        $this->forge->createTable($this->tb_name);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
