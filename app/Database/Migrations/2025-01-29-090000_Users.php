<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    protected $tb_name = "users";

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
                'constraint' => '100'
            ],
            'avatar'       => [
                'type'      => 'TINYTEXT',
                'null'      => true
            ],
            'email' => [
                'type'       => 'BLOB',
            ],
            'phone' => [
                'type'       => 'BLOB',
            ],
            'password'       => [
                'type'       => 'BLOB',
            ],
            'document'       => [
                'type'       => 'BLOB'
            ],
            'document_type'  => [
                'type'       => 'VARCHAR',
                'constraint' => '35',
                'null'       => true
            ],
            'birthdate'       => [
                'type'       => 'DATE',
            ],
            'keyword'       => [
                'type'       => 'BLOB',
            ],
            'status' => [
                'type' => 'ENUM("ACTIVE", "INACTIVE", "ANALYSIS")',
                'default' => "ANALYSIS"
            ],
            'email_sha256'       => [
                'type'       => 'VARCHAR',
                'constraint' => '70',
                'unique'     => true
            ],
            'phone_sha256'       => [
                'type'       => 'VARCHAR',
                'constraint' => '70',
                'unique'     => true
            ],
            'document_sha256'       => [
                'type'       => 'VARCHAR',
                'constraint' => '70',
                'unique'         => true
            ],
            'system_key'       => [
                'type'       => 'BLOB'
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at datetime',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable($this->tb_name, true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
