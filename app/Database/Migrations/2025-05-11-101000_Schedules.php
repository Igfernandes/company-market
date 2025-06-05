<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Schedules extends Migration
{
    protected $tb_name = "schedules";

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
            ],
            'describe' => [
                'type' => 'TINYTEXT',
                'null' => true
            ],
            'color' => [
                'type' => 'VARCHAR(15)'
            ],
            'date' => [
                'type' => 'DATETIME'
            ],
            'end_date' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);

        $this->forge->addKey(['id'], true);
        $this->forge->createTable($this->tb_name);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
