<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CustomForms extends Migration
{
    protected $tb_name = "custom_forms";

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
                'constraint' => '200'
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => '250'
            ],
            'type' => [
                'type' => 'ENUM("PEOPLE","COMPANY")',
            ],
            'components' => [
                'type'       => 'JSON',
            ],
            'description' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null'       => true
            ],
            'status' => [
                'type'       => 'ENUM("PUBLISHED", "DRAFT")'
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
