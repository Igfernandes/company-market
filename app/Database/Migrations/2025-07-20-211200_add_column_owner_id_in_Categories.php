<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnColorMarkAndThanksMessageInCustomForms extends Migration
{
    protected $tb_name = "categories";

    public function up()
    {
        $this->forge->addColumn($this->tb_name, [
            'owner_id' => [
                'type' => 'INT',
                'null' => true
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn($this->tb_name, 'owner_id');
    }
}
