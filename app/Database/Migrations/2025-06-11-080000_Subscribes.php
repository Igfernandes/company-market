<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Subscribes extends Migration
{
    protected $tb_name = "subscribes";

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'phone_sha256' => [
                'type'       => 'VARCHAR',
                'constraint' => '70'
            ],
            "type" => [
                'type' => 'VARCHAR(20)'
            ],
            'data' => [
                'type' => 'JSON'
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
