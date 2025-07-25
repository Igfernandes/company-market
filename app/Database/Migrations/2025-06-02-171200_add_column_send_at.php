<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnSendAt extends Migration
{
    protected $tb_name = "clients_messages_dispatcher";

    public function up()
    {
        $this->forge->addColumn($this->tb_name, [
            'send_at' => [
                'type' => 'datetime',
                'after' => 'log_error'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn($this->tb_name, 'send_at');
    }
}
