<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnExpiredAtCharges extends Migration
{
    protected $tb_name = "charges";

    public function up()
    {
        $this->forge->addColumn($this->tb_name, [
            'expired_at' => [
                'type'       => 'DATE',
                'null'       => true,
                'after'      => 'type' // opcional: define onde o campo será inserido
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn($this->tb_name, 'expired_at');
    }
}
