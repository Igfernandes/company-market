<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Charges extends Migration
{
    protected $tb_name = "charges";

    public function up()
    {
        $this->forge->addColumn($this->tb_name, [
            'status' => [
                'type'       => 'ENUM("ACTIVE", "INACTIVE")',
                'default'    => "ACTIVE",
                'after'      => 'description' // opcional: define onde o campo será inserido
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn($this->tb_name, 'status');
    }
}
