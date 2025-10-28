<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class contents extends Migration
{
    protected $tb_name = "contents";

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR(150)'
            ],
            'image' => [
                'type' => 'TINYTEXT',
                'null' => true
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'status' => [
                'type' => 'ENUM("ACTIVE", "INACTIVE")'
            ],
            'address' => [
                'type' => 'VARCHAR(250)',
                'null' => true
            ],
            'realized_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'closed_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable($this->tb_name, true);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
