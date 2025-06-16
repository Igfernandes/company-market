<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveColumnReservationsInServices extends Migration
{
    protected $tb_name = "services";

    public function up()
    {
        $db = \Config\Database::connect();
        $fields = $db->getFieldNames($this->tb_name);

        if (in_array('reservations', $fields)) {
            $this->forge->dropColumn($this->tb_name, 'reservations');
        }
    }

    public function down()
    {
        $fields = [
            'reservations' => [
                'reservations' => 'INT',
                'null'         => false,
                'after'        => 'stock'
            ],
        ];

        $this->forge->addColumn($this->tb_name, $fields);
    }
}
