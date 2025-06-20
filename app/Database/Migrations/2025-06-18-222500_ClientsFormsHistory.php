<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ClientsFormsHistory extends Migration
{
    protected $tb_name = "clients_forms_history";

    public function up()
    {
        $this->forge->addField([
            'client_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'form_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            "package" => [
                "type" => "VARCHAR(90)"
            ],
            'created_at datetime default current_timestamp'
        ]);

        $this->forge->addKey(['client_id', 'form_id'], true);

        $this->forge->addForeignKey("client_id", "clients", ["id"]);
        $this->forge->addForeignKey("form_id", "forms", ["id"]);

        $this->forge->createTable($this->tb_name);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
