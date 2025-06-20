<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnIsConfirmInClientsServices extends Migration
{
    protected $tb_name = "clients_services";

    public function up()
    {
        $this->forge->addColumn($this->tb_name, [
            'is_confirm' => [
                'type'     => 'BIT',
                'after'    => 'service_id',
                'default'   => 0, // ou false, dependendo da regra de negócio
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn($this->tb_name, 'is_confirm');
    }
}
