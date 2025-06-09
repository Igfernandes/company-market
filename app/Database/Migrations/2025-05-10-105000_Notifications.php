<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Notifications extends Migration
{
    protected $tb_name = "notifications";

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type' => 'VARCHAR(200)',
                'null' => true
            ],
            'message' => [
                'type' => 'VARCHAR(250)',
                'null' => true
            ],
            'action' => [
                'type' => 'VARCHAR(20)'
            ],
            'scope' => [
                'type' => 'VARCHAR(50)',
                'null' => true
            ],
            'key' => [
                'type'           => 'INT',
                'null' => true
            ],
            'author_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'created_at datetime default current_timestamp'
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable($this->tb_name);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
