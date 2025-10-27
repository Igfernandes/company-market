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
                'constraint' => '150',
                'null' => true,
            ],
            'avatar'       => [
                'type'      => 'TINYTEXT',
                'null'      => true,
            ],
            'phone' => [
                'type'       => 'BLOB',
            ],
            'email' => [
                'type'       => 'BLOB',
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
                'type'       => 'BLOB'
            ],
            'phone_sha256'       => [
                'type'       => 'VARCHAR',
                'constraint' => '70',
                'unique'     => true
            ],
            'document'       => [
                'type'       => 'BLOB',
            ],
            'document_type'  => [
                'type'       => 'VARCHAR',
                'constraint' => '35',
                'null'       => true
            ],
            'owner_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'           => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at datetime',
        ]);

        $this->forge->addForeignKey("owner_id", "users", ["id"]);

        $this->forge->addKey('id', true);
        $this->forge->createTable($this->tb_name, true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
