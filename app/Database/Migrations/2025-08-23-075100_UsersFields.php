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
                'type' => 'INT',
                'unsigned'       => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned'       => true,
            ],
            'value' => [
                'type' => "VARCHAR(250)",
                'null' => true
            ],
            'value_encrypted' => [
                'type' => "BLOB",
                'null' => true
            ],
            'created_at datetime default current_timestamp'
        ]);

        $this->forge->addKey(['user_id', 'field_id'], true);
        $this->forge->addForeignKey("field_id", "fields", ["id"], 'CASCADE');
        $this->forge->addForeignKey("user_id", "users", ["id"], 'CASCADE');

        $this->forge->createTable($this->tb_name, true);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
