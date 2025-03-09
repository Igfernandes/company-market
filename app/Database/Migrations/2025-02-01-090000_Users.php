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
            'surname' => [
                'type' => 'VARCHAR',
                'constraint' => '45'
            ],
            'avatar'       => [
                'type'       => 'TINYTEXT',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'unique'     => true
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'unique'     => true
            ],
            'password'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'cpf'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'unique'         => true
            ],
            'birthdate'       => [
                'type'       => 'DATE',
            ],
            'keyword'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'status' => [
                'type' => 'ENUM("ACTIVE", "INACTIVE", "ANALYSIS")',
                'default' => "ANALYSIS"
            ],
            'email_sha1'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
                'null' => true
            ],
            'twof_secret'       => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => true
            ],
            'system_key'       => [
                'type'       => 'VARCHAR',
                'constraint' => '400',
                'null' => true
            ],
            'owner_id' => [
                'type' => 'INT',
                'null' => true
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
