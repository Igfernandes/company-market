<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersSettingsPrivacy extends Migration
{
    protected $tb_name = "users_settings_privacy";

    public function up()
    {
        $this->forge->addField([
            'settings_privacy_id' => [
                'type'           => 'INT',
                'unsigned' => true
            ],
            'user_id' => [
                'type'           => 'INT',
                'unsigned' => true
            ],
            'ip' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
                'null' => true
            ],
            'browser' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
                'null' => true
            ],
            'created_at datetime default current_timestamp'
        ]);

        $this->forge->addKey(['settings_privacy_id', 'user_id'], true);

        $this->forge->addForeignKey("settings_privacy_id", "settings_privacy", ["id"]);
        $this->forge->addForeignKey("user_id", "users", ["id"]);

        $this->forge->createTable($this->tb_name);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
