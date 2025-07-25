<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnOwnerIdInClients extends Migration
{
    protected $tb_name = "clients";

    public function up()
    {
        $this->forge->addColumn($this->tb_name, [
            'owner_id' => [
                'type'     => 'VARCHAR(10)',
                'default' => '#7ae3aa',
                'after'    => 'status',
                'null'     => true, // ou false, dependendo da regra de negócio
            ],
            'thanks_message' => [
                'type'     => 'TEXT',
                'after'    => 'color_mark',
                'null'     => true, // ou false, dependendo da regra de negócio
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn($this->tb_name, 'color_mark');
        $this->forge->dropColumn($this->tb_name, 'thanks_message');
    }
}
