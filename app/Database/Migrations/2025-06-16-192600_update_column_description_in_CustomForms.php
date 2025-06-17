<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateColumnDescriptionInCustomForms extends Migration
{
    protected $tb_name = "custom_forms";

    public function up()
    {
        $db = \Config\Database::connect();
        $this->db->query("
            ALTER TABLE `{$db->getPrefix()}{$this->tb_name}`
            MODIFY `description` TINYTEXT
        ");
    }
    public function down()
    {
        $db = \Config\Database::connect();
        $this->db->query("
            ALTER TABLE `{$db->getPrefix()}{$this->tb_name}`
            MODIFY `description` VARCHAR(250)
        ");
    }
}
