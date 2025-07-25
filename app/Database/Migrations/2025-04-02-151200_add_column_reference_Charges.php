<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnReferenceAtCharges extends Migration
{
    protected $tb_name = "charges";

    public function up()
    {
        $this->forge->addColumn($this->tb_name, [
            'reference' => [
                'type'   => 'VARCHAR(50)',
                'after'  => 'promotional_price' // opcional: define onde o campo será inserido
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn($this->tb_name, 'reference');
    }
}
