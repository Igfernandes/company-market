<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnAlertsInServices extends Migration
{
    protected $tb_name = "services";

    public function up()
    {
        $this->forge->addColumn($this->tb_name, [
            'alerts' => [
                'type' => 'TEXT',
                'after' => 'description'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn($this->tb_name, 'alerts');
    }
}
