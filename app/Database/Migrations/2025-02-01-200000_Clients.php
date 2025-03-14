<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Clients extends Migration
{
    protected $tb_name = "clients";

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
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'avatar'       => [
                'type'      => 'TINYTEXT',
                'null'      => true,
                'null' => true,
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'unique'     => true
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'birthdate'       => [
                'type'       => 'DATE',
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM("ACTIVE", "INACTIVE")'
            ],
            'system_key'       => [
                'type'       => 'VARCHAR',
                'constraint' => '400',
                'null' => true
            ],
            'phone_sha1'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
                'null' => true
            ],
            'owner_id' => [
                'type' => 'INT',
                'null' => true
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable($this->tb_name, true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
