<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ClientsFields extends Migration
{
    protected $tb_name = "clients_fields";

    public function up()
    {
        $this->forge->addField([
            'field_id' => [
                'type' => 'INT',
                'unsigned'       => true,
            ],
            'client_id' => [
                'type' => 'INT',
                'unsigned'       => true,
            ],
            'value' => [
                'type' => "JSON",
                'true' => true
            ],
            'created_at datetime default current_timestamp'
        ]);

        $this->forge->addKey(['client_id', 'field_id'], true);
        $this->forge->addForeignKey("field_id", "fields", ["id"]);
        $this->forge->addForeignKey("client_id", "clients", ["id"]);

        $this->forge->createTable($this->tb_name);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
