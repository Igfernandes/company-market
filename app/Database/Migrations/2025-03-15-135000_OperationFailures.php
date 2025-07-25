<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OperationFailures extends Migration
{
    protected $tb_name = "operation_failures";

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'operation_type' => [
                'type' => 'VARCHAR(50)',
                'null' => true
            ],
            'provider' => [
                'type' => 'VARCHAR(100)',
                'null' => true
            ],
            'error_message' => [
                'type' => 'VARCHAR(250)',
                'null' => true
            ],
            'error_code' => [
                'type' => 'INT'
            ],
            'payload_sent' => [
                'type' => 'JSON',
                'null' => true
            ],
            'response_received' => [
                'type' => 'JSON'
            ],
            'attempt_number' => [
                'type' => 'INT',
                'null' => true
            ],
            'should_retry' => [
                'type' => 'TINYINT'
            ],
            'status' => [
                'type' => 'ENUM("PENDING", "RETRYING", "FAILED", "RESOLVED")'
            ],
            'resolved_at datetime',
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
