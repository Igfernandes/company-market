<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateColumnPlatformInMessagesDispatchers extends Migration
{
    protected $tb_name = "messages_dispatcher";

    public function up()
    {
        $db = \Config\Database::connect();
        $this->db->query("
            ALTER TABLE `{$db->getPrefix()}{$this->tb_name}`
            MODIFY `platforms` SET('FACEBOOK', 'INSTAGRAM', 'WHATSAPP', 'EMAIL', 'DEVICE') NOT NULL
        ");
    }
    public function down()
    {
        $db = \Config\Database::connect();
        $this->db->query("
            ALTER TABLE `{$db->getPrefix()}{$this->tb_name}`
            MODIFY `platforms` SET('FACEBOOK', 'INSTAGRAM', 'WHATSAPP', 'EMAIL', 'SMS') NOT NULL
        ");
    }
}
