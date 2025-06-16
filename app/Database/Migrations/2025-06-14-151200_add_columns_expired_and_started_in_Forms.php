<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnExpiredAtAndStartedAtInForms extends Migration
{
    protected $tb_name = "custom_forms";

    public function up()
    {
        $this->forge->addColumn($this->tb_name, [
            'started_at' => [
                'type' => 'datetime',
                'after' => 'status'
            ],
            'expired_at' => [
                'type' => 'datetime',
                'after' => 'started_at'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn($this->tb_name, 'started_at');
         $this->forge->dropColumn($this->tb_name, 'expired_at');
    }
}
