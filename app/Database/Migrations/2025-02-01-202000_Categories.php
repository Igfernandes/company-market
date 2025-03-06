<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
{
    protected $tb_name = "categories";

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
            'description' => [
                'type'       => 'VARCHAR',
                'constraint' => '300'
            ],
            'position' => [
                'type' => 'INT',
            ],
            'status' => [
                'type' => 'ENUM("ACTIVE", "INACTIVE")'
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
