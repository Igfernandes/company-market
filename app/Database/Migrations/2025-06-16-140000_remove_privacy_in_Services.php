<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveColumnPrivacyInServices extends Migration
{
    protected $tb_name = "services";

    public function up()
    {
        $db = \Config\Database::connect();
        $fields = $db->getFieldNames($this->tb_name);

        if (in_array('privacy', $fields)) {
            $this->forge->dropColumn($this->tb_name, 'privacy');
        }
    }

    public function down()
    {
        $fields = [
            'privacy' => [
                'privacy' => 'INT',
                'null'         => false,
                'after'        => 'status'
            ],
        ];

        $this->forge->addColumn($this->tb_name, $fields);
    }
}
