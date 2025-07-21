<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SettingsPrivacy extends Migration
{
    protected $tb_name = "settings_privacy";

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
                'type' => 'VARCHAR',
                'constraint' => '250'
            ],
            'describe' => [
                'type' => 'TEXT'
            ],
            'path' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable($this->tb_name, true);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
