<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Fields extends Migration
{
    protected $tb_name = "fields";

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
            'component' => [
                'type' => 'ENUM("INPUT")',
                'default' => 'INPUT'
            ],
            'type' => [
                'type' => "VARCHAR(50)",
                'null' => true
            ],
            'is_sensitive' => [
                'type' => "BIT",
                'default' => 0
            ],
            'is_required' => [
                'type' => "BIT",
                'default' => 0
            ],
            'group_id' => [
                'type' => 'INT',
                'unsigned'       => true
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey("group_id", "fields_groups", ["id"]);
        $this->forge->createTable($this->tb_name, true);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
