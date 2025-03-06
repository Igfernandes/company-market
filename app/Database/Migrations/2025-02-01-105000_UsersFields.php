<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersFields extends Migration
{
    protected $tb_name = "users_fields";

    public function up()
    {
        $this->forge->addField([
            'field_id' => [
                'type' => 'INT'
            ],
            'user_id' => [
                'type' => 'INT'
            ],
            'value' => [
                'type' => "JSON"
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey("field_id", "fields", ["id"]);
        $this->forge->addForeignKey("user_id", "users", ["id"]);

        $this->forge->createTable($this->tb_name);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
