<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Integrations extends Migration
{
    protected $tb_name = "integrations";

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'provider' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'type'       => [
                'type'      => 'VARCHAR',
                'constraint' => '50'
            ],
            'settings' => [
                'type'       => 'BLOB',
            ],
            'status' => [
                'type' => 'ENUM("ACTIVE", "INACTIVE")'
            ],
            'system_key'       => [
                'type'       => 'BLOB'
            ],
            'company_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addForeignKey("company_id", "companies", ["id"]);

        $this->forge->addKey('id', true);
        $this->forge->createTable($this->tb_name, true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable($this->tb_name);
    }
}
