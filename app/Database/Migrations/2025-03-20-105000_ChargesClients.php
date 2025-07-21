<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChargesClients extends Migration
{
    protected $tb_name = "charges_clients";

    public function up()
    {
        $this->forge->addField([
            'charge_id' => [
                'type' => 'INT',
                'unsigned'       => true,
            ],
            'client_id' => [
                'type' => 'INT',
                'unsigned'       => true,
            ],
            'created_at datetime default current_timestamp'
        ]);

        $this->forge->addKey(['charge_id', 'client_id'], true);
        $this->forge->addForeignKey("charge_id", "charges", ["id"]);
        $this->forge->addForeignKey("client_id", "clients", ["id"]);
        $this->forge->createTable($this->tb_name, true);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
