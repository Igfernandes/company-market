<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Permissions extends Migration
{
    protected $tb_name = "permissions";

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'type' => [
                'type'       => 'ENUM("CREATE", "UPDATE", "DELETE", "VIEW")'
            ],
            'scope' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ]
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable($this->tb_name, true);
    }

    public function down()
    {

        $this->forge->dropTable($this->tb_name);
    }
}
