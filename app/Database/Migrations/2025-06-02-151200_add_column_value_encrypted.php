<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnValueEncrypted extends Migration
{
    protected $tb_name = "clients_fields";

    public function up()
    {
        $this->forge->addColumn($this->tb_name, [
            'value_encrypted' => [
                'type'   => 'BLOB',
                'null'   => true,
                'after'  => 'value' // opcional: define onde o campo será inserido
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn($this->tb_name, 'value_encrypted');
    }
}
