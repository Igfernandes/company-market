<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Clients extends Migration
{
    protected $tb_name = "clients";

    public function up()
    {
        $this->forge->addColumn($this->tb_name, [
            'email_sha1' => [
                'type'   => 'VARCHAR(200)',
                'null' => true,
                'after'  => 'phone_sha1' // opcional: define onde o campo será inserido
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn($this->tb_name, 'email_sha1');
    }
}
