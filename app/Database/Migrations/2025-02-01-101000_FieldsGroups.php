<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FieldsGroup extends Migration
{
    protected $tb_name = "fields_groups";

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
                'type'       => 'VARCHAR',
                'constraint' => '100'
            ],
            'position' => [
                'type'       => 'SET("USER","COMPANY")',
            ],
            'created_at datetime default current_timestamp',
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable($this->tb_name);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
