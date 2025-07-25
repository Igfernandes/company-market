<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ServicesRules extends Migration
{
    protected $tb_name = "services_rules";

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'service_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            "label" => [
                "type" => "VARCHAR(100)"
            ],
            "condition" => [
                "type" => "VARCHAR(180)",
            ],
            "column" => [
                "type" => "VARCHAR(20)"
            ],
            "value" => [
                "type" => "VARCHAR(200)"
            ],
            'created_at datetime default current_timestamp'
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey("service_id", "services", ["id"]);

        $this->forge->createTable($this->tb_name, true);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
