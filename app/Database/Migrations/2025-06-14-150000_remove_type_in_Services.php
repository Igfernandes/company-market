<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveColumnTypeInServices extends Migration
{
    protected $tb_name = "services";

    public function up()
    {
        $db = \Config\Database::connect();
        $fields = $db->getFieldNames($this->tb_name);
        
        if (in_array('type', $fields)) {
            $this->forge->dropColumn($this->tb_name, 'type');
        }
    }

    public function down()
    {
        $fields = [
            'type' => [
                'type'       => 'ENUM("APPELLANT", "PUNCTUAL")',
                'null'       => false,
                'after'      => 'photo'
            ],
        ];

        $this->forge->addColumn($this->tb_name, $fields);
    }
}
