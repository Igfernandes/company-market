<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CustomFormsHistory extends Migration
{
    protected $tb_name = "custom_forms_history";

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            "description" => [
                'type' => 'VARCHAR',
                'constraint' => '250',
                'null' => true
            ],
            'form_id' => [
                'type' => 'INT'
            ],
            'user_id' => [
                'type' => 'INT'
            ],
            'created_at datetime default current_timestamp'
        ]);

        $this->forge->addKey('id', true);

        $this->forge->addForeignKey("form_id", "custom_forms", ["id"]);
        $this->forge->addForeignKey("user_id", "users", ["id"]);
        $this->forge->createTable($this->tb_name);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
