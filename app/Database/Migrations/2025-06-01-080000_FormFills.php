<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FormFills extends Migration
{
    protected $tb_name = "form_fills";

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'form_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            "package" => [
                'type' => 'VARCHAR(90)'
            ],
            'field_id' => [
                'type' => 'VARCHAR(100)'
            ],
            'value' => [
                'type' => 'BLOB'
            ],
            'created_at datetime default current_timestamp'
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey("form_id", "custom_forms", ["id"]);
        $this->forge->createTable($this->tb_name, true);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
