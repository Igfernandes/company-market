<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Charges extends Migration
{
    protected $tb_name = "charges";

    public function up()
    {
        $this->forge->addColumn($this->tb_name, [
            'privacy' => [
                'type' => 'ENUM("PUBLIC", "PRIVATE")',
                'default' => "PUBLIC",
                'after'      => 'status' // opcional: define onde o campo será inserido
            ],
            'amount' => [
                'type'       => 'Integer',
                'default'    => '1',
                'after'      => 'privacy' // opcional: define onde o campo será inserido
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn($this->tb_name, 'amount');
        $this->forge->dropColumn($this->tb_name, 'privacy');
    }
}
