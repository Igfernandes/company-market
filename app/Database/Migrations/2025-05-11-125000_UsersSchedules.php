<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersSchedules extends Migration
{
    protected $tb_name = "users_schedules";

    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'schedule_id' => [
                'type' => 'INT',
                'unsigned' => true
            ]
        ]);

        $this->forge->addKey(['user_id', 'schedule_id'], true);
        $this->forge->addForeignKey("user_id", "users", ["id"]);
        $this->forge->addForeignKey("schedule_id", "schedules", ["id"]);
        $this->forge->createTable($this->tb_name);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
