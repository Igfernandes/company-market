<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SettingsHistory extends Migration
{
    protected $tb_name = "settings_history";

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'module' => [
                'type' => 'VARCHAR(50)'
            ],
            'operation' => [
                'type' => 'VARCHAR(50)'
            ],
            'payload_sent' => [
                'type' => 'JSON',
                'null' => true
            ],
            'status' => [
                'type' => 'ENUM("PENDING", "SUCCESS", "FAILED")'
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
