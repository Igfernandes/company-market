<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Services extends Migration
{
    protected $tb_name = "services";

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
                'type' => 'VARCHAR(200)'
            ],
            'photo' => [
                'type' => 'TINYTEXT',
                'null' => true
            ],
            'type' => [
                'type' => 'ENUM("APPELLANT", "PUNCTUAL")'
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'status' => [
                'type' => 'ENUM("ACTIVE", "INACTIVE")'
            ],
            'privacy' => [
                'type' => 'ENUM("PUBLIC", "PRIVATE")'
            ],
            'stock' => [
                'type' => 'INT',
            ],
            'reservations' => [
                'type' => 'INT'
            ],
            'address' => [
                'type' => 'VARCHAR(250)',
                'null' => true
            ],
            'realized_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'expired_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable($this->tb_name);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
