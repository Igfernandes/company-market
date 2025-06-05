<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnSha256AtClients extends Migration
{
    protected $tb_name = "clients";

    public function up()
    {
        $this->forge->addColumn($this->tb_name, [
            'email_sha256' => [
                'type'   => 'VARCHAR(70)',
                'unique' => true,
                'after'  => 'phone_sha256' // opcional: define onde o campo será inserido
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn($this->tb_name, 'email_sha256');
    }
}
