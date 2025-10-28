<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dispatchers extends Migration
{
    protected $tb_name = "dispatchers";

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
            'reference' => [
                'type' => 'VARCHAR(100)',
            ],
            'content' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'period' => [
                'type' => 'ENUM("DAILY", "WEEKLY", "MONTHLY")',
                'null' => true
            ],
            'platforms' => [
                'type' => 'SET("FACEBOOK", "INSTAGRAM", "WHATSAPP", "EMAIL", "SMS")',
            ],
            'status' => [
                'type' => 'ENUM("ACTIVE", "INACTIVE")'
            ],
            'scheduled_day' => [
                'type' => 'INT',
                'null' => true
            ],
            'weekday' => [
                'type' => 'SET("SUNDAY", "MONDAY", "TUESDAY", "WEDNESDAY", "THURSDAY", "FRIDAY", "SATURDAY")',
                'null' => true
            ],
            'service_id' => [
                'type' => 'INT',
                'null' => true,
                'unsigned' => true
            ],
            'charge_id' => [
                'type' => 'INT',
                'null' => true,
                'unsigned' => true
            ],
            'author_id' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'started_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey("content_id", "contents", ["id"]);
        $this->forge->addForeignKey("author_id", "users", ["id"]);
        $this->forge->createTable($this->tb_name, true);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
