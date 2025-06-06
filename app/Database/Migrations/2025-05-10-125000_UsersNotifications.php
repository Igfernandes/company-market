<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersNotifications extends Migration
{
    protected $tb_name = "users_notifications";

    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'notification_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'created_at datetime default current_timestamp'
        ]);

        $this->forge->addKey(['user_id', 'notification_id'], true);
        $this->forge->addForeignKey("user_id", "users", ["id"]);
        $this->forge->addForeignKey("notification_id", "notifications", ["id"]);
        $this->forge->createTable($this->tb_name);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
