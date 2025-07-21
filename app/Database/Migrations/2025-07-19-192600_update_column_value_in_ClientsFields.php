<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateColumnValueInClientsFields extends Migration
{
    protected $tb_name = "clients_fields";

    public function up()
    {
        $db = \Config\Database::connect();
        $this->db->query("
            ALTER TABLE `{$db->getPrefix()}{$this->tb_name}`
            MODIFY `value` TINYTEXT NULL
        ");
    }
    public function down()
    {
        $db = \Config\Database::connect();
        $this->db->query("
            ALTER TABLE `{$db->getPrefix()}{$this->tb_name}`
            MODIFY `value` JSON
        ");
    }
}
