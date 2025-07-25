<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Remember extends Migration
{
    protected $tb_name = "remember";

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'token' => [
                'type' => 'VARCHAR',
                'constraint' => '20'
            ],
            'ip' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'created_at datetime default current_timestamp',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey("user_id", "users", ["id"]);
        $this->forge->createTable($this->tb_name, true);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
