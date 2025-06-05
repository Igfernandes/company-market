<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Charges extends Migration
{
    protected $tb_name = "charges";

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type' => 'VARCHAR(100)',
                'null' => true
            ],
            'description' => [
                'type' => 'MEDIUMTEXT',
                'null' => true
            ],
            'price' => [
                'type' => 'DECIMAL(10,2)',
                'null' => true
            ],
            'promotional_price' => [
                'type' => 'DECIMAL(10,2)',
                'null' => true
            ],
            'service_id' => [
                'type' => 'INT'
            ],
            'type' => [
                'type' => 'ENUM("APPELLANT", "PUNCTUAL")',
                'null' => true
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey("service_id", "services", ["id"]);
        $this->forge->createTable($this->tb_name);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
